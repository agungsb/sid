<?php

session_start();

require_once '../../koneksi.php';
if (isset($_POST['kode'])) {
    $kode = "aktivitas_mengajar_dosen.kode_kegiatan_mengajar_dosen='" . $_POST['kode'] . "' AND";
} else {
    $kode = "";
}

$query = "SELECT aktivitas_mengajar_dosen.*, perguruan_tinggi.kode_perguruan_tinggi, perguruan_tinggi.nama_pt, "
        . "program_studi.kode_program_studi, program_studi.nama_program_studi, jenjang_pendidikan.kode_jenjang_pendidikan, jenjang_pendidikan.deskripsi, "
        . "semester.kode_semester, semester.nama_semester, mata_kuliah.kode_mata_kuliah, mata_kuliah.nama_mata_kuliah ";
$query .= "FROM aktivitas_mengajar_dosen, perguruan_tinggi, program_studi, semester, mata_kuliah, jenjang_pendidikan ";
$query .= "WHERE $kode aktivitas_mengajar_dosen.kode_program_studi = program_studi.kode_program_studi AND aktivitas_mengajar_dosen.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah "
        . "AND aktivitas_mengajar_dosen.semester_pelaporan = semester.kode_semester AND aktivitas_mengajar_dosen.kode_jenjang_pendidikan = jenjang_pendidikan.kode_jenjang_pendidikan "
        . "AND aktivitas_mengajar_dosen.kode_perguruan_tinggi = perguruan_tinggi.kode_perguruan_tinggi ORDER BY aktivitas_mengajar_dosen.tahun_pelaporan DESC, aktivitas_mengajar_dosen.semester_pelaporan DESC, aktivitas_mengajar_dosen.kode_mata_kuliah DESC";
$stmnt = $dbh->prepare($query);
//echo $query;
if ($stmnt->execute()) {
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"aktivitas_mengajar_dosen":"' . $row['kode_kegiatan_mengajar_dosen'] . '",';
        $output .= '"nidn":"' . $row['nidn'] . '",';
        $output .= '"kode_perguruan_tinggi":"' . $row['kode_perguruan_tinggi'] . '",';
        $output .= '"nama_perguruan_tinggi":"' . $row['nama_pt'] . '",';
        $output .= '"kode_program_studi":"' . $row['kode_program_studi'] . '",';
        $output .= '"nama_program_studi":"' . $row['nama_program_studi'] . '",';
        $output .= '"kode_jenjang_pendidikan":"' . $row['kode_jenjang_pendidikan'] . '",';
        $output .= '"nama_jenjang_pendidikan":"' . $row['deskripsi'] . '",';
        $output .= '"kode_mata_kuliah":"' . $row['kode_mata_kuliah'] . '",';
        $output .= '"nama_mata_kuliah":"' . $row['nama_mata_kuliah'] . '",';
        $output .= '"kode_semester":"' . $row['kode_semester'] . '",';
        $output .= '"nama_semester":"' . $row['nama_semester'] . '",';
        $output .= '"tahun_akademik":"' . $row['tahun_pelaporan'] . '"}';
    }
    $output .= "]";

    echo ($output);
} else {
    echo PDO::ERRMODE_EXCEPTION;
}
