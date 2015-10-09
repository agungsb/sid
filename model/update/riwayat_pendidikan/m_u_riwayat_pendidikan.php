<?php

session_start();

require_once '../../koneksi.php';

if (isset($_POST['kode_perguruan_tinggi']) && isset($_POST['kode_gelar_akademik']) && isset($_POST['tanggal_ijazah']) && isset($_POST['kode_jenjang_pendidikan']) && isset($_POST['kode_riwayat_pendidikan_dosen'])) {
    $kode_perguruan_tinggi = $_POST['kode_perguruan_tinggi'];
    $kode_gelar_akademik = $_POST['kode_gelar_akademik'];
    $tanggal_ijazah = yyMmDd($_POST['tanggal_ijazah']);
    $kode_jenjang_pendidikan = $_POST['kode_jenjang_pendidikan'];
    $kode_riwayat_pendidikan_dosen = $_POST['kode_riwayat_pendidikan_dosen'];

    $query = "UPDATE `riwayat_pendidikan_dosen` SET kode_perguruan_tinggi='$kode_perguruan_tinggi', gelar_akademik='$kode_gelar_akademik', "
            . "tanggal_ijazah='$tanggal_ijazah', kode_jenjang_pendidikan='$kode_jenjang_pendidikan' "
            . "WHERE kode_riwayat_pendidikan_dosen='$kode_riwayat_pendidikan_dosen'";
    $stmnt = $dbh->prepare($query);
    try {
        $stmnt->execute();
        echo "SUKSES";
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

function yyMmDd($string) {
    $date = explode("-", $string);
    $result = $date[2] . "-" . $date[1] . "-" . $date[0];
    return $result;
}
