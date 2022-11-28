<?php

if(isset($_POST["submit"])){
    $name = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $cpwd = $_POST["cpwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $email, $pwd, $cpwd) !== false){
        session_start();
        $_SESSION["message"] = "Fill all the information.";
        header("location: ../signup.php");
        exit();
    }
    if(uidExists($conn, $name, $email) !== false){
        session_start();
        $_SESSION["message"] = "Username already exists.";
        header("location: ../signup.php");
        exit();
    }

    createUser($conn, $name, $email, $pwd, $cpwd);
}
else{
    header("location: ../signup.php");
    exit();
}
