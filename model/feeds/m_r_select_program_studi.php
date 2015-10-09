<?php

session_start();

require_once '../koneksi.php';

$query = "SELECT * FROM `program_studi`";
$stmnt = $dbh->prepare($query);
$stmnt->execute();
$output = "[";
while ($row = $stmnt->fetch()) {
    if ($output != "[") {
        $output .= ",";
    }
    $output .= '{"kode_program_studi":"' . $row['kode_program_studi'] . '",';
    $output .= '"nama_program_studi":"' . $row["nama_program_studi"] . '"}';
}
$output .= "]";

echo ($output);


function query(){
    
}