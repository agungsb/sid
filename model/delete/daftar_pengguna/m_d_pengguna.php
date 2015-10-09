<?php

session_start();

require_once '../../koneksi.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM `riwayat_mengajar_dosen` WHERE kode_riwayat_mengajar_dosen='$id'";
    $stmnt = $dbh->prepare($query);
    if ($stmnt->execute()) {
        $output = "Sukses";

        echo ($output);
    } else {
        echo PDO::ERRMODE_EXCEPTION;
    }
}  else {
    header("Location: ../../../index.php");
}