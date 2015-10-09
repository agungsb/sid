<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../koneksi.php';

    $nidn = $_SESSION['nidn'];

    $query = "SELECT * FROM `semester`";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_semester":"' . $row['kode_semester'] . '",';
        $output .= '"nama_semester":"' . $row["nama_semester"] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    header("Location: ../../index.php");
}
