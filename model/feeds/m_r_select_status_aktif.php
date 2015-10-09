<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../koneksi.php';

    $nidn = $_SESSION['nidn'];

    $query = "SELECT * FROM `status_aktif`";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_status_aktif":"' . $row['kode_status_aktif'] . '",';
        $output .= '"nama_status_aktif":"' . $row["nama_status_aktif"] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    header("Location: ../../index.php");
}
