<?php

if(isset($_POST["submit"]) && !empty($_POST['username']) && !empty($_POST['pwd'])){
    $name = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    loginUser($conn, $name, $pwd);
}
else{
    header("location: ../login.html?error=emptyinput");
    exit();
}
