<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../koneksi.php';

    $nidn = $_SESSION['nidn'];

    $query = "SELECT * FROM `provinsi`";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_provinsi":"' . $row['kode_provinsi'] . '",';
        $output .= '"nama_provinsi":"' . $row["nama_provinsi"] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    header("Location: ../../index.php");
}
