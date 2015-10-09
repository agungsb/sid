<?php

session_start();

require_once '../../koneksi.php';

$nidn = "";

if (isset($_SESSION['nidn'])) {
    if (isset($_GET['nidn'])) {
        $nidn = $_GET['nidn'];
    } else {
        $nidn = $_SESSION['nidn'];
    }
} else {
    if (isset($_GET['nidn'])) {
        $nidn = $_GET['nidn'];
    }
}

//$nidn = "0024087402";

$query = "SELECT dosen.*, program_studi.nama_program_studi, kota.nama_kota, provinsi.nama_provinsi, negara.nama_negara, perguruan_tinggi.nama_pt, "
        . "fakultas.nama_fakultas, jurusan.nama_jurusan, agama.nama_agama, status_aktif.nama_status_aktif ";
$query .= "FROM dosen, program_studi, kota, provinsi, negara, perguruan_tinggi, fakultas, jurusan,agama, status_aktif ";
$query .= "WHERE dosen.nidn='$nidn' AND dosen.kode_program_studi = program_studi.kode_program_studi AND dosen.kode_kota = kota.kode_kota "
        . "AND dosen.kode_provinsi = provinsi.kode_provinsi AND dosen.kode_negara = negara.kode_negara "
        . "AND dosen.kode_perguruan_tinggi = perguruan_tinggi.kode_perguruan_tinggi AND dosen.kode_agama = agama.kode_agama "
        . "AND dosen.kode_fakultas = fakultas.kode_fakultas AND dosen.kode_jurusan = jurusan.kode_jurusan "
        . "AND dosen.status_aktif = status_aktif.kode_status_aktif";

$stmnt = $dbh->prepare($query);
//echo $query;
try {
    $stmnt->execute();
    $output = "[";
    while ($row = $stmnt->fetch()) {
        if ($output != "[") {
            $output .= ",";
        }
        $output .= '{"nidn":"' . $row['nidn'] . '",';
        $output .= '"nama_dosen":"' . $row["nama_dosen"] . '",';
        $output .= '"gelar_akademik_depan":"' . $row["gelar_akademik_depan"] . '",';
        $output .= '"gelar_akademik_belakang":"' . $row["gelar_akademik_belakang"] . '",';
        $output .= '"nip_lama":"' . $row["nip_lama"] . '",';
        $output .= '"nip_baru":"' . $row["nip_baru"] . '",';
        $output .= '"no_ktp":"' . $row["no_ktp"] . '",';
        $output .= '"jenis_kelamin":"' . $row["jenis_kelamin"] . '",';
        $output .= '"tempat_lahir":"' . $row["tempat_lahir"] . '",';
        $output .= '"tanggal_lahir":"' . $row["tanggal_lahir"] . '",';
        $output .= '"alamat":"' . $row["alamat"] . '",';
        $output .= '"kode_kota":"' . $row["kode_kota"] . '",';
        $output .= '"nama_kota":"' . $row["nama_kota"] . '",';
        $output .= '"kode_provinsi":"' . $row["kode_provinsi"] . '",';
        $output .= '"nama_provinsi":"' . $row["nama_provinsi"] . '",';
        $output .= '"kode_pos":"' . $row["kode_pos"] . '",';
        $output .= '"nama_negara":"' . $row["nama_negara"] . '",';
        $output .= '"telepon":"' . $row["telepon"] . '",';
        $output .= '"hp":"' . $row["hp"] . '",';
        $output .= '"kode_perguruan_tinggi":"' . $row["kode_perguruan_tinggi"] . '",';
        $output .= '"nama_perguruan_tinggi":"' . $row["nama_pt"] . '",';
        $output .= '"kode_fakultas":"' . $row["kode_fakultas"] . '",';
        $output .= '"nama_fakultas":"' . $row["nama_fakultas"] . '",';
        $output .= '"kode_jurusan":"' . $row["kode_jurusan"] . '",';
        $output .= '"nama_jurusan":"' . $row["nama_jurusan"] . '",';
        $output .= '"kode_program_studi":"' . $row["kode_program_studi"] . '",';
        $output .= '"nama_program_studi":"' . $row["nama_program_studi"] . '",';
        $output .= '"golongan":"' . $row["golongan"] . '",';
        $output .= '"pangkat":"' . $row["pangkat"] . '",';
        $output .= '"jabatan_fungsional":"' . $row["jabatan_fungsional"] . '",';
        $output .= '"jabatan_struktural":"' . $row["jabatan_struktural"] . '",';
        $output .= '"kode_jabatan_akademik":"' . $row["kode_jabatan_akademik"] . '",';
        $output .= '"status_aktif":"' . $row["nama_status_aktif"] . '",';
        $output .= '"mulai_masuk_dosen":"' . $row['mulai_masuk_dosen'] . '",';
        $output .= '"mulai_semester":"' . $row['mulai_semester'] . '",';
        $output .= '"no_sertifikasi_dosen":"' . $row['no_sertifikasi_dosen'] . '",';
        $output .= '"tanggal_keluar_sertifikasi_dosen":"' . $row['tanggal_keluar_sertifikasi_dosen'] . '",';
        $output .= '"pasfoto":"' . $row['pasfoto'] . '",';
        $output .= '"email":"' . $row['email'] . '"}';
    }
    $output .= "]";

    echo ($output);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
