<?php

session_start();

require_once '../../koneksi.php';

if (isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    $status = $_POST['status'];
    $query = "UPDATE `list_user` SET status='" . $status . "' WHERE userid='$userid'";
    $stmnt = $dbh->prepare($query);
    try {
        $stmnt->execute();
        $output = $query;
    } catch (PDOException $ex) {
        $output = $ex->getMessage();
    }
    echo ($output);
}