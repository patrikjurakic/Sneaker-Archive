<?php

if(isset($_POST["submit"])){
    session_start();
    $username = $_SESSION["username"];
    $userimg = $_SESSION["userimg"];
    $title = $_POST["title"];
    $text = $_POST["text"];
    $img = $_POST["img"];
    $userid = $_SESSION["userid"];
    $date = date("Y-m-d");

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    createpost($conn, $title, $text, $img, $username, $userimg, $date);
}
else{
    header("location: ../createpost.php");
    exit();
}
