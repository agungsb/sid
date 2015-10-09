<?php

session_start();

require_once '../koneksi.php';

if (isset($_POST['nidn'])) {
    $nidn = $_POST['nidn'];
    $query = "SELECT * FROM `dosen` WHERE nidn='$nidn'";
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
}