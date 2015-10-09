<?php

session_start();

require_once '../../koneksi.php';
if (isset($_POST['kode'])) {
    $kode = "riwayat_pendidikan_dosen.kode_riwayat_pendidikan_dosen='" . $_POST['kode'] . "' AND";
} else {
    $kode = "";
}

$query = "SELECT riwayat_pendidikan_dosen.*, perguruan_tinggi.nama_pt, program_studi.nama_program_studi, jenjang_pendidikan.deskripsi, kelompok_bidang_ilmu.nama_kelompok_bidang_ilmu, gelar_akademik.* ";
$query .= "FROM riwayat_pendidikan_dosen, perguruan_tinggi, program_studi, kelompok_bidang_ilmu, jenjang_pendidikan, gelar_akademik ";
$query .= "WHERE $kode riwayat_pendidikan_dosen.kode_program_studi = program_studi.kode_program_studi AND riwayat_pendidikan_dosen.gelar_akademik = gelar_akademik.kode_gelar_akademik "
        . "AND riwayat_pendidikan_dosen.kode_jenjang_pendidikan = jenjang_pendidikan.kode_jenjang_pendidikan AND riwayat_pendidikan_dosen.kode_kelompok_bidang_ilmu = kelompok_bidang_ilmu.kode_kelompok_bidang_ilmu "
        . "AND riwayat_pendidikan_dosen.kode_perguruan_tinggi = perguruan_tinggi.kode_perguruan_tinggi ORDER BY tanggal_ijazah DESC";
$stmnt = $dbh->prepare($query);
//echo $query;
if ($stmnt->execute()) {
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"kode_riwayat_pendidikan_dosen":"' . $row['kode_riwayat_pendidikan_dosen'] . '",';
        $output .= '"nidn":"' . $row['nidn'] . '",';
        $output .= '"kode_gelar_akademik":"' . $row['kode_gelar_akademik'] . '",';
        $output .= '"nama_gelar_akademik":"' . $row['nama_gelar_akademik'] . '",';
        $output .= '"tanggal_ijazah":"' . $row['tanggal_ijazah'] . '",';
        $output .= '"kode_jenjang_pendidikan":"' . $row['kode_jenjang_pendidikan'] . '",';
        $output .= '"nama_jenjang_pendidikan":"' . $row['deskripsi'] . '",';
        $output .= '"kode_perguruan_tinggi":"' . $row['kode_perguruan_tinggi'] . '",';
        $output .= '"nama_perguruan_tinggi":"' . $row['nama_pt'] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    echo PDO::ERRMODE_EXCEPTION;
}
