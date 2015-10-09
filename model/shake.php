<?php

require_once 'koneksi.php';

session_start();

if ((isset($_SESSION['token'])) && (isset($_POST['token']))) {
    $key = $_POST['token'];
    if ($_SESSION['token'] == $key) {
        query($dbh);
    } else {
        echo "GAGAL";
    }
}

function query($dbh) {
    $query = "SELECT * FROM `gelar_akademik` WHERE pos='belakang'";
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
}
