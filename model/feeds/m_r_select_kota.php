<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../koneksi.php';

    $nidn = $_SESSION['nidn'];

    $query = "SELECT * FROM `kota`";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_kota":"' . $row['kode_kota'] . '",';
        $output .= '"nama_kota":"' . $row["nama_kota"] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    header("Location: ../../index.php");
}
    