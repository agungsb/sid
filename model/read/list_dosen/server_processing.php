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
$table = "`dosen`";

// Join condition
$myJoin = "LEFT JOIN `fakultas` ON `dosen`.`kode_fakultas` = `fakultas`.`kode_fakultas` ";
$myJoin .= "LEFT JOIN `jurusan` ON `dosen`.`kode_jurusan` = `jurusan`.`kode_jurusan`";
$myJoin .= "LEFT JOIN `program_studi` ON `dosen`.`kode_program_studi` = `program_studi`.`kode_program_studi`";

// Table's primary key
$primaryKey = "`dosen`.`nidn`";

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => '`dosen`.`nidn`', 'dt' => '0'),
    array('db' => '`dosen`.`nip_baru`', 'dt' => '1'),
    array('db' => '`dosen`. `nama_dosen`', 'dt' => '2'),
    array('db' => '`fakultas`. `nama_fakultas`', 'dt' => '3'),
    array('db' => '`jurusan`. `nama_jurusan`', 'dt' => '4'),
    array('db' => '`program_studi`. `nama_program_studi`', 'dt' => '5'),
    array(
        'db' => '`dosen`.`nidn`',
        'dt' => '6',
        'formatter' => function( $d, $row ) {
            return "<a href='detail/" . $d . "' class='btn btn-warning col-md-12'><i class='glyphicon glyphicon-user'></i></a>";
        }
    ),
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
        SSP::simple($_GET, $db, $table, $primaryKey, $columns, $myJoin, "")
        //SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
