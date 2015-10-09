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
    $kode_riwayat_mengajar_dosen = $_POST['kode_riwayat_mengajar_dosen'];

    $query = "UPDATE `aktivitas_mengajar_dosen` SET kode_program_studi='$kode_program_studi', "
            . "kode_jenjang_pendidikan='$kode_jenjang_pendidikan', kode_mata_kuliah='$kode_mata_kuliah', "
            . "semester_pelaporan='$kode_semester', tahun_pelaporan='$tahun_akademik' "
            . "WHERE kode_kegiatan_mengajar_dosen='$kode_riwayat_mengajar_dosen'";
    $stmnt = $dbh->prepare($query);
    try {
        $stmnt->execute();
        echo "SUKSES";
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
