<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sneakerusers";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn){
    die("Connection to DB failed: ". mysqli_connect_error());
}
?>
