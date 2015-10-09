<?php

session_start();

require_once '../../koneksi.php';

if ((isset($_POST['userid'])) && (isset($_POST['password']))) {
    $userid = filter_input(INPUT_POST, "userid");
    $password = filter_input(INPUT_POST, "password");
    $level = filter_input(INPUT_POST, "level");
    ubahStatusAkun($dbh, $userid);
    $query = "INSERT INTO `list_user`(userid, status, password, level) "
            . "VALUES('" . $userid . "', '1', '" . hash("sha256", $password) . "', 'dosen')";
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

function ubahStatusAkun($dbh, $userid) {
    $query = "UPDATE `dosen` SET akun='1' WHERE nidn='$userid'";
    $stmnt = $dbh->prepare($query);
    try {
        $stmnt->execute();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
