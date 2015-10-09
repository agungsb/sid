<?php

session_start();

require_once '../../koneksi.php';

if (isset($_POST['column']) && (isset($_POST['data']))) {
    $column = filter_input(INPUT_POST, "column");
    $data = htmlspecialchars(filter_input(INPUT_POST, "data"));

    $nidn = $_SESSION['nidn'];

    if (($column == "tanggal_lahir") || ($column == "mulai_masuk_dosen") || ($column == "tanggal_keluar_sertifikasi_dosen")) {
        $data = yyMmDd($data);
    }

    $query = "UPDATE `dosen` SET $column='$data' WHERE nidn='" . $_SESSION['nidn'] . "'";
    $stmnt = $dbh->prepare($query);
    if ($stmnt->execute()) {
        $output = $query;
    } else {
        $output = "Gagal";
    }

    echo ($output);
} else {
    header("Location: ../../../index.php");
}

function yyMmDd($string) {
    $date = explode("-", $string);
    $result = $date[2] . "-" . $date[1] . "-" . $date[0];
    return $result;
}
