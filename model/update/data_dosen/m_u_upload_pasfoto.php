<?php

session_start();

require_once '../../koneksi.php';

$src = $_POST['src'];
/*
 * 

  $encodedData = str_replace(' ', '+', $src);
  $decodedData = base64_decode($encodedData);

  $output = array("src" => $decodedData);
  $output = array("src" => $encodedData);
 */

$query = "UPDATE `dosen` SET pasfoto='" . $src . "' WHERE nidn='" . $_SESSION['nidn'] . "'";
$stmnt = $dbh->prepare($query);
if ($stmnt->execute()) {
    $output = array("src" => $src);
} else {
    $output = "Gagal";
}
echo json_encode($output);

