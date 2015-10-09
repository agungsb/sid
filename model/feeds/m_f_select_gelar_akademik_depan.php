<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../koneksi.php';

    $nidn = $_SESSION['nidn'];

    $query = "SELECT * FROM `gelar_akademik` WHERE pos='depan'";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_gelar_akademik":"' . $row['kode_gelar_akademik'] . '",';
        $output .= '"nama_gelar_akademik":"' . $row["nama_gelar_akademik"] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    header("Location: ../../index.php");
}
    