<?php

session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$sneakerID = $_GET["sneakid"];

echo $sneakerID;

if(isset($_SESSION["username"])){
$username = $_SESSION['username'];

$query1 = "SELECT sneakers FROM users WHERE usersName = '$username'";
if($result1 = $conn->query($query1)){
    while ($row = $result1->fetch_assoc()){
        if(strstr($row["sneakers"], ", " . $sneakerID)){
            $query = "UPDATE users SET sneakers = REPLACE(sneakers, ', $sneakerID','') WHERE usersName = '$username'";

            if ($result = $conn->query($query)) {
                echo "<h1> removed </h1>";
                header("location: ../profile.php");
            } 
            else {
            echo "<h1> couldn't remove </h1>";
            header("location: ../sneakerPage.php");
            };
        }
        else{
            $query = "UPDATE users SET sneakers = concat(sneakers, ', $sneakerID') WHERE usersName = '$username'";

            if ($result = $conn->query($query)) {
                echo "<h1> added </h1>";
                header("location: ../profile.php");
            } 
            else {
            echo "<h1> couldn't add </h1>";
            header("location: ../sneakerPage.php");
            };
        }
    }
}

    
}
else{
    header("location: ../login.php");
}



