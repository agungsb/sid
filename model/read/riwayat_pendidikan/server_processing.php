<?php

session_start();
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
$table = "`riwayat_pendidikan_dosen`";

// Join condition
$myJoin = "LEFT JOIN `perguruan_tinggi` ON `riwayat_pendidikan_dosen`.`kode_perguruan_tinggi` = `perguruan_tinggi`.`kode_perguruan_tinggi` ";
$myJoin .= "LEFT JOIN `program_studi` ON `riwayat_pendidikan_dosen`.`kode_program_studi` = `program_studi`.`kode_program_studi`";
$myJoin .= "LEFT JOIN `jenjang_pendidikan` ON `riwayat_pendidikan_dosen`.`kode_jenjang_pendidikan` = `jenjang_pendidikan`.`kode_jenjang_pendidikan`";
$myJoin .= "LEFT JOIN `gelar_akademik` ON `riwayat_pendidikan_dosen`.`gelar_akademik` = `gelar_akademik`.`kode_gelar_akademik`";

// Table's primary key
$primaryKey = "`riwayat_pendidikan_dosen`.`kode_riwayat_pendidikan_dosen`";

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => '`perguruan_tinggi`. `nama_pt`', 'dt' => '0'),
    array('db' => '`gelar_akademik`. `nama_gelar_akademik`', 'dt' => '1'),
    array(
        'db' => '`riwayat_pendidikan_dosen`. `tanggal_ijazah`',
        'dt' => '2',
        'formatter' => function( $d, $row ) {
            $converted = explode("-", $d);
            $tanggal = $converted[2] . "-" . $converted[1] . "-" . $converted[0];
            return $tanggal;
        }
    ),
    array('db' => '`jenjang_pendidikan`. `deskripsi`', 'dt' => '3'),
    array(
        'db' => '`riwayat_pendidikan_dosen`. `kode_riwayat_pendidikan_dosen`',
        'dt' => '4',
        'formatter' => function( $d, $row ) {
            return "<form action='/sid/user/data/edit_riwayat_pendidikan_dosen' method='POST'>"
                    . "<input type='hidden' value='$d' name='kode'/>"
                    . "<button class='btn btn-warning col-md-12'>"
                    . "<i class='fa fa-edit'></i>"
                    . "</button>"
                    . "</form>";
        }
    ),
    array(
        'db' => '`riwayat_pendidikan_dosen`. `kode_riwayat_pendidikan_dosen`',
        'dt' => '5',
        'formatter' => function( $d, $row ) {
            return "<button id='$d' class='bdelete btn btn-danger col-md-12'>"
                    . "<i class='fa fa-times bdelete'></i>"
                    . "</button>";
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
        SSP::simple($_GET, $db, $table, $primaryKey, $columns, $myJoin, "")
        //SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
