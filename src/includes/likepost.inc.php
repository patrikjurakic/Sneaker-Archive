<?php

session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$postid = $_GET['id'];


if(isset($_SESSION["username"])){
$username = $_SESSION['username'];
$query1 = "SELECT likes FROM posts WHERE postID = $postid";
if($result1 = $conn->query($query1)){
    while ($row = $result1->fetch_assoc()){
        if (strstr($row['likes'], $username)){
            if (strstr($row['likes'], ', ' . $username)){
                $query = "UPDATE posts SET likes = REPLACE(likes, ', $username','') WHERE postID = $postid";
                echo "already here";
                if ($result = $conn->query($query)) {
                    echo "<h1> DISLIKED </h1>";
                    header("location: ../home.php");
                }
            }
            else{
                $query = "UPDATE posts SET likes = REPLACE(likes, '$username,','') WHERE postID = $postid";
                echo "already here";
                if ($result = $conn->query($query)) {
                    echo "<h1> DISLIKED </h1>";
                    header("location: ../home.php");
                }
            }
        }
        else{
            if (!empty($row["likes"])){
                $query = "UPDATE posts SET likes = concat(likes, ', $username') WHERE postID = $postid";

                if ($result = $conn->query($query)) {
                    echo "<h1> LIKED </h1>";
                    header("location: ../home.php");
                }
            }
            else{
                $query = "UPDATE posts SET likes = concat(likes, '$username') WHERE postID = $postid";

                if ($result = $conn->query($query)) {
                    echo "<h1> LIKED </h1>";
                    header("location: ../home.php");
                }
            }
        }
    }
}
}
else{
    header("location: ../login.php");
}



