<?php

session_start();

require_once '../koneksi.php';



$query = "SELECT * FROM `dosen` WHERE (status_aktif != 'K' OR status_aktif != 'L' OR status_aktif != 'P') AND akun='0'";
$stmnt = $dbh->prepare($query);
$stmnt->execute();
$output = "[";
while ($row = $stmnt->fetch()) {
    if ($output != "[") {
        $output .= ",";
    }
    $output .= '{"nidn":"' . $row['nidn'] . '"}';
}
$output .= "]";

echo ($output);
