<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = "`list_user`";

// Join condition
$myJoin = "LEFT JOIN `dosen` ON `list_user`.`userid` = `dosen`.`nidn` ";
$myJoin .= "LEFT JOIN `status_aktif` ON `dosen`.`status_aktif` = `status_aktif`.`kode_status_aktif` ";

// Table's primary key
$primaryKey = "`list_user`.`userid`";

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => '`list_user`.`userid`', 'dt' => '0'),
    array('db' => '`list_user`.`password`', 'dt' => '1'),
    array('db' => '`list_user`.`level`', 'dt' => '2'),
    array(
        'db' => '`list_user`. `status`',
        'dt' => '3',
        'formatter' => function( $d, $row ) {
            if ($d == "1") {
                $output = "Aktif";
            } else if ($d == "0") {
                $output = "Non Aktif";
            }
            return $output;
        }
    ),
    array(
        'db' => '`list_user`. `userid`',
        'dt' => '4',
        'formatter' => function( $d, $row ) {
            return "<form action='/sid/user/daftar_pengguna/edit' method='POST'>"
                    . "<input type='hidden' value='$d' name='userid'/>"
                    . "<button class='btn btn-warning col-md-12'>"
                    . "<i class='fa fa-edit'></i>"
                    . "</button>"
                    . "</form>";
        }
    )
);


// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db' => 'sid',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp_class.php' );

$db = "sid";
$user = "root";
$password = "";

$db = new PDO("mysql:host=localhost;dbname=$db", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

echo json_encode(
        SSP::simple($_GET, $db, $table, $primaryKey, $columns, $myJoin, "level != 'admin_sid'")
        //SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
