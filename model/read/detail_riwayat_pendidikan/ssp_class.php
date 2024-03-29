<?php

class SSP {

    /**
     * Create the data output array for the DataTables rows
     *
     *  @param  array $columns Column information array
     *  @param  array $data    Data from the SQL get
     *  @return array          Formatted data in a row based format
     */
    static function data_output($columns, $data) {
        //show $data values in file since it cannot be echo'ed out
        //file_put_contents('/home/test/public_html/filename.txt', print_r($data, true));

        $out = array();

        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();

            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j];

                // Is there a formatter?
                if (isset($column['formatter'])) {
                    $row[$column['dt']] = $column['formatter']($data[$i][$column['dt']], $data[$i]);
                } else {
                    $row[$column['dt']] = $data[$i][$columns[$j]['dt']];
                }
            }

            $out[] = $row;
        }

        return $out;
    }

    /**
     * Paging
     *
     * Construct the LIMIT clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL limit clause
     */
    static function limit($request, $columns) {
        $limit = '';

        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }

        return $limit;
    }

    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL order by clause
     */
    static function order($request, $columns) {
        $order = '';

        if (isset($request['order']) && count($request['order'])) {
            $orderBy = array();
            $dtColumns = SSP::pluck($columns, 'dt');

            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];

                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];

                if ($requestColumn['orderable'] == true) {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                            'ASC' :
                            'DESC';

                    $orderBy[] = '' . $column['db'] . ' ' . $dir;
                }
            }

            $order = 'ORDER BY ' . implode(', ', $orderBy);
        }

        return $order;
    }

    /**
     * Searching / Filtering
     *
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here performance on large
     * databases would be very poor
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @param  array $bindings Array of values for PDO bindings, used in the
     *    sql_exec() function
     *  @return string SQL where clause
      EDIT : added $mywhere functionality for passing initial filtering conditions
     */
    static function filter($request, $columns, &$bindings, $myWhere) {
        $globalSearch = array();
        $columnSearch = array();
        $dtColumns = SSP::pluck($columns, 'dt');

        if (isset($request['search']) && $request['search']['value'] != '') {
            $str = $request['search']['value'];

            for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];

                if ($requestColumn['searchable'] == 'true') {
                    $binding = SSP::bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                    $globalSearch[] = "" . $column['db'] . " LIKE " . $binding;
                }
            }
        }

        // Individual column filtering
        for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            $requestColumn = $request['columns'][$i];
            $columnIdx = array_search($requestColumn['data'], $dtColumns);
            $column = $columns[$columnIdx];

            $str = $requestColumn['search']['value'];

            if ($requestColumn['searchable'] == 'true' &&
                    $str != '') {
                $binding = SSP::bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                $columnSearch[] = "" . $column['db'] . " LIKE " . $binding;
            }
        }

        // Combine the filters into a single string
        $where = "riwayat_pendidikan_dosen.nidn='" . $_GET['nidn'] . "'";

        if (count($globalSearch)) {
            $where = '(' . implode(' OR ', $globalSearch) . ')';
        }

        if (count($columnSearch)) {
            $where = $where === '' ?
                    implode(' AND ', $globalSearch) :
                    $where . ' AND ' . implode(' AND ', $globalSearch);
        }

        if ($where !== '') {
            $where = 'WHERE ' . $where;

            // add my clause
            if ($myWhere !== '') {
                $where .= ' AND ' . $myWhere;
            }
        }

        if ($where == '' && $myWhere !== '') {
            // add my clause
            $where = 'WHERE ' . $myWhere;
        }

        return $where;
    }

    /**
     * Perform the SQL queries needed for an server-side processing requested,
     * utilising the helper functions of this class, limit(), order() and
     * filter() among others. The returned array is ready to be encoded as JSON
     * in response to an SSP request, or can be modified if needed before
     * sending back to the client.
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $sql_details SQL connection details - see sql_connect()
     *  @param  string $table SQL table to query
     *  @param  string $primaryKey Primary key of the table
     *  @param  array $columns Column information array
     *  @return array          Server-side processing response array
     */
    static function simple($request, $db, $table, $primaryKey, $columns, $myJoin, $myWhere) {
        $bindings = array();
        //$db = SSP::sql_connect( $sql_details );
        // Build the SQL query string from the request
        $limit = SSP::limit($request, $columns);
        $order = SSP::order($request, $columns);
        $where = SSP::filter($request, $columns, $bindings, $myWhere);

        // Main query to actually get the data
        $data = SSP::sql_exec($db, $bindings,
                        //"SELECT SQL_CALC_FOUND_ROWS ".implode(", ", SSP::pluck($columns, 'db'))."
                        "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", SSP::pluckAs($columns)) . "
             FROM $table
             $myJoin
             $where
             $order
             $limit"
        );

        // Data set length after filtering
        $resFilterLength = SSP::sql_exec($db, "SELECT FOUND_ROWS()"
        );
        $recordsFiltered = $resFilterLength[0][0];

        //add my initial where clause for correct results
        $dataWhere = ($myWhere !== '' ? 'WHERE ' . $myWhere : '');

        // Total data set length        
        $resTotalLength = SSP::sql_exec($db, "SELECT COUNT({$primaryKey})
             FROM $table
             $myJoin
             $dataWhere"
        );
        $recordsTotal = $resTotalLength[0][0];

        /*
         * Output
         */
        return array(
            "draw" => intval($request['draw']),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => SSP::data_output($columns, $data)
        );
    }

    /**
     * Execute an SQL query on the database
     *
     * @param  resource $db  Database handler
     * @param  array    $bindings Array of PDO binding values from bind() to be
     *   used for safely escaping strings. Note that this can be given as the
     *   SQL query string if no bindings are required.
     * @param  string   $sql SQL query to execute.
     * @return array         Result from the query (all rows)
     */
    static function sql_exec($db, $bindings, $sql = null) {
        // Argument shifting
        if ($sql === null) {
            $sql = $bindings;
        }
        //echo var_dump($sql);
        $stmt = $db->prepare($sql);
        //echo $sql;
        // Bind parameters
        if (is_array($bindings)) {
            for ($i = 0, $ien = count($bindings); $i < $ien; $i++) {
                $binding = $bindings[$i];
                $stmt->bindValue($binding['key'], $binding['val'], $binding['type']);
            }
        }

        // Execute
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            SSP::fatal("An SQL error occurred: " . $e->getMessage());
        }

        // Return all
        return $stmt->fetchAll();
    }

    /*     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Internal methods
     */

    /**
     * Throw a fatal error.
     *
     * This writes out an error message in a JSON string which DataTables will
     * see and show to the user in the browser.
     *
     * @param  string $msg Message to send to the client
     */
    static function fatal($msg) {
        echo json_encode(array(
            "error" => $msg
        ));

        exit(0);
    }

    /**
     * Create a PDO binding key which can be used for escaping variables safely
     * when executing a query with sql_exec()
     *
     * @param  array &$a    Array of bindings
     * @param  *      $val  Value to bind
     * @param  int    $type PDO field type
     * @return string       Bound key to be used in the SQL where this parameter
     *   would be used.
     */
    static function bind(&$a, $val, $type) {
        $key = ':binding_' . count($a);

        $a[] = array(
            'key' => $key,
            'val' => $val,
            'type' => $type
        );

        return $key;
    }

    /**
     * Pull a particular property from each assoc. array in a numeric array, 
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @param  string $prop Property to read
     *  @return array        Array of property values
     */
    static function pluck($a, $prop) {
        $out = array();

        for ($i = 0, $len = count($a); $i < $len; $i++) {
            $out[] = $a[$i][$prop];
        }

        return $out;
    }

    /**
     * Create and return select array in the format `db` AS `dt` 
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @return array        Array of property values
     */
    static function pluckAs($a) {
        $out = array();

        for ($i = 0, $len = count($a); $i < $len; $i++) {
            $out[] = $a[$i]['db'] . " AS `" . $a[$i]['dt'] . "`";
        }

        return $out;
    }

}

?>