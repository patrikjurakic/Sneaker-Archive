<?php

session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$postid = $_GET['pid'];

   if (isset($postid)){

      $query = "DELETE FROM posts WHERE postID = $postid;";

      if(mysqli_query($conn, $query)){
         header("location: ../home.php?=noerror");
         unset($postid);
      exit();
      }
      else{
         header("location: ../home.php?=error");
         exit();
      };
   }

    
