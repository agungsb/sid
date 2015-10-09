<?php

session_start();

require_once '../koneksi.php';

$query = "SELECT * FROM `fakultas`";
$stmnt = $dbh->prepare($query);
$stmnt->execute();
$output = "[";
while ($row = $stmnt->fetch()) {
    if ($output != "[") {
        $output .= ",";
    }
    $output .= '{"kode_fakultas":"' . $row['kode_fakultas'] . '",';
    $output .= '"nama_fakultas":"' . $row["nama_fakultas"] . '"}';
}
$output .= "]";

echo ($output);
