<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../koneksi.php';

    $nidn = $_SESSION['nidn'];

    $query = "SELECT * FROM `perguruan_tinggi`";
    $stmnt = $dbh->prepare($query);
    $stmnt->execute();
    $i = 0;
    //$output = "[";
    while ($row = $stmnt->fetch()) {
        /*
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_perguruan_tinggi":"' . $row['kode_perguruan_tinggi'] . '",';
        $output .= '"nama_perguruan_tinggi":"' . $row["nama_pt"] . '"}';
         * 
         */
        $output[$i] = array("kode_perguruan_tinggi"=>$row['kode_perguruan_tinggi'], "nama_perguruan_tinggi"=>$row['nama_pt']);
        $i++;
    }
    //$output .= "]";

    echo json_encode($output);
} else {
    header("Location: ../../index.php");
}
