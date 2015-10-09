<?php

$db = "sid";
$user = "root";
$password = "";

try {
    $dbh = new PDO("mysql:host=localhost;dbname=$db", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
