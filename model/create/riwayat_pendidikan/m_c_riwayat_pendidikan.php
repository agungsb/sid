<?php

session_start();

require_once '../../koneksi.php';

if (isset($_POST['kode_perguruan_tinggi']) && (isset($_POST['kode_gelar_akademik'])) && (isset($_POST['tanggal_ijazah'])) && (isset($_POST['kode_jenjang_pendidikan']))) {
    $nidn = $_SESSION['nidn'];
    $kode_perguruan_tinggi = filter_input(INPUT_POST, "kode_perguruan_tinggi");
    $kode_gelar_akademik = filter_input(INPUT_POST, "kode_gelar_akademik");
    $tanggal_ijazah = yyMmDd($_POST['tanggal_ijazah']);
    $kode_jenjang_pendidikan = filter_input(INPUT_POST, "kode_jenjang_pendidikan");

    $query = "INSERT INTO `riwayat_pendidikan_dosen`(kode_perguruan_tinggi, kode_program_studi, kode_jenjang_pendidikan, nidn, gelar_akademik, kode_kelompok_bidang_ilmu, tanggal_ijazah) "
            . "VALUES('" . $kode_perguruan_tinggi . "', '1', '" . $kode_jenjang_pendidikan . "', '" . $nidn . "', '" . $kode_gelar_akademik . "', 'E', '" . $tanggal_ijazah . "')";
    $stmnt = $dbh->prepare($query);
    //echo var_dump($stmnt);
    //die();
    if ($stmnt->execute()) {
        $output = "Sukses";
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
