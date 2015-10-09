<?php

session_start();

if (isset($_SESSION['nidn'])) {

    require_once '../../koneksi.php';

    $nidn = $_SESSION['nidn'];

    //$nidn = "123456789";

    $query = "SELECT dosen.nidn, dosen.nama_dosen, dosen.pasfoto, dosen.gelar_akademik_depan, dosen.gelar_akademik_belakang FROM `dosen` WHERE dosen.nidn='$nidn'";
    $stmnt = $dbh->prepare($query);
    if ($stmnt->execute()) {
        $output = "[";
        while ($row = $stmnt->fetch()) {
            if ($output != "[") {
                $output .= ",";
            }
            $output .= '{"nidn":"' . $row['nidn'] . '",';
            $output .= '"gelar_akademik_depan":"' . $row["gelar_akademik_depan"] . '",';
            $output .= '"nama_dosen":"' . $row["nama_dosen"] . '",';
            $output .= '"gelar_akademik_belakang":"' . $row["gelar_akademik_belakang"] . '",';
            $output .= '"pasfoto":"' . $row['pasfoto'] . '"}';
        }
        $output .= "]";

        echo ($output);
    } else {
        die(mysql_error());
    }
} else {
    header("Location: ../../index.php");
}
