<?php

session_start();

require_once '../../koneksi.php';

if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $password = hash("sha256", $_POST['password']);
    $query = "UPDATE `list_user` SET password='" . $password . "' WHERE userid='$userid'";
    $stmnt = $dbh->prepare($query);
    try {
        $stmnt->execute();
        $output = $query;
    } catch (PDOException $ex) {
        $output = $ex->getMessage();
    }

    echo ($output);
}