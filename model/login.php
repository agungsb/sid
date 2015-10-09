<?php

session_start();

if (isset($_POST['id']) && isset($_POST['password'])) {

    require_once 'koneksi.php';

    $nidn = $_POST['id'];
    $password = $_POST['password'];
    //$nidn = "123456789";
    $query = "SELECT * FROM `list_user` WHERE userid='$nidn'";
    $stmnt = $dbh->prepare($query);
    try {
        $stmnt->execute();
        if ($stmnt->rowCount() < 1) {
            $output = "User tidak ditemukan!";
        } else {
            $qpass = "SELECT * FROM `list_user` WHERE userid = ? AND password = ?";
            $spass = $dbh->prepare($qpass);
            $spass->bindValue(1, "$nidn", PDO::PARAM_STR);
            $spass->bindValue(2, "" . hash("sha256", $password) . "", PDO::PARAM_STR);
            $spass->execute();
            if ($spass->rowCount() < 1) {
                $output = "Password salah!";
            } else {
                $row = $spass->fetch();
                $_SESSION['nidn'] = $row['userid'];
                $_SESSION['level'] = $row['level'];
                $output = true;
            }
        }
        echo $output;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
} else {
    echo "Terjadi kesalahan! Mohon periksa kembali input anda.";
}

