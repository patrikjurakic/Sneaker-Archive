<?php

if(isset($_POST["submit"])){
    $name = $_POST["username"];
    $info = $_POST["userinfo"];
    $img = $_POST["userimg"];
    session_start();
    $userid = $_SESSION["userid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $query = "UPDATE users SET usersName = '$name', usersInfo = '$info', usersImg = '$img'  WHERE usersId = $userid;";

    if(mysqli_query($conn, $query)){
       $message = 'Data Updated';
       $_SESSION["username"] = $name;
       $_SESSION["userinfo"] = $info;
       $_SESSION["userimg"] = $img;
       header("location: ../profile.php?=noerror");
        exit();
    }
    else{
       header("location: ../home.php?=error");
        exit();
    };  
}
else{
    header("location: ../profileedit.php?=error");
    exit();
}
