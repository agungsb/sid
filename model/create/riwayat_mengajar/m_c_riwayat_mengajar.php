<?php

session_start();

require_once '../../koneksi.php';

if ((isset($_POST['kode_program_studi'])) && (isset($_POST['kode_jenjang_pendidikan'])) && (isset($_POST['kode_mata_kuliah'])) && (isset($_POST['kode_semester'])) && (isset($_POST['tahun_akademik']))) {
    $nidn = $_SESSION['nidn'];
    $kode_program_studi = filter_input(INPUT_POST, "kode_program_studi");
    $kode_jenjang_pendidikan = filter_input(INPUT_POST, "kode_jenjang_pendidikan");
    $kode_mata_kuliah = filter_input(INPUT_POST, "kode_mata_kuliah");
    $kode_semester = filter_input(INPUT_POST, "kode_semester");
    $tahun_akademik = filter_input(INPUT_POST, "tahun_akademik");

    $query = "INSERT INTO `aktivitas_mengajar_dosen`(kode_perguruan_tinggi, kode_program_studi, kode_jenjang_pendidikan, nidn, semester_pelaporan, tahun_pelaporan, kode_mata_kuliah) "
            . "VALUES('001037', '" . $kode_program_studi . "', '" . $kode_jenjang_pendidikan . "', '" . $nidn . "', '" . $kode_semester . "', '" . $tahun_akademik . "', '" . $kode_mata_kuliah . "')";
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
