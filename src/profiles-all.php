<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    <?php
    

    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    $username = $_GET["username"];

    echo $username;
    ?>
  </title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="icon" type="image/x-icon" href="favicon.png">
</head>
<body>
  <nav>
    <div class="nav-center">
      <div class="nav-header">
        <img src="./sneaker.archive.png" class="logo" alt="">
     <button class="nav-toggle">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <ul class="links">
        <li>
        <?php
          session_start();
          if(isset($_SESSION["userid"])){
            echo "
            <a style='color:#BCCEF8;' href='profile.php'>" . $_SESSION["username"] . "</a>";
          }
          else{
          }
        ?>
        </li>
        <li>
          <a href="home.php">Home</a>
        </li>
        <li>
        <?php
          if(isset($_SESSION["userid"])){
            echo "<a href='browseusers.php'>Browse users</a>";
          }
        ?>
        </li>
        <li>
          <a href="archive.php">Sneaker Archive</a>
        </li>
        <li>
        <?php
          if(isset($_SESSION["userid"])){
            echo "<a href='includes/logout.inc.php'>Log out</a>";
          }
          else{
            echo "<a href='login.html'>Login</a>";
          }
        ?>
        </li>
      </ul>
    </div>
  </nav>
  <section class="animate__animated animate__fadeInRightBig">
      <section class="profile">
        <?php
          $query2 = "SELECT * FROM users WHERE usersName = '$username'";
          if ($result2 = $conn->query($query2)) {
                $row2 = $result2->fetch_assoc();
          };

          $userimg = $row2["usersImg"];

          echo "<img src='". $userimg;
          echo "'>";
        ?>
            <div class="info">
                <?php
                    if(isset($row2["verified"])){
                      echo "<h1 class='verified'>". $row2["usersName"] ."<i class='fa-solid fa-circle-check' style='--fa-animation-duration: 1s;  position: relative; top: -1em; left: 0.5em; font-size: 40%; color:#7bdff2;'></i> </h1>";
                    }
                    else{
                      echo "<h1>". $row2["usersName"] ."</h1>";
                    };
                if(isset($row2["usersInfo"])){
                    echo "<p>". $row2["usersInfo"] ."</p>";
                }
                ?>
            </div>  
      </section> 
      <section class="container">
      <?php
        if($row2["sneakers"] !== "-"){  
        echo '<h3><i class="fa-solid fa-heart"></i> Favorite sneakers:</h3>
            
        <div id="sneaker-cards" class="sneaker-profile">
        </div>';
        }
      ?>
      
      <h3><i class="fa-solid fa-clone"></i> Posts:</h3>
      <div style="display: block; width: 100%;">
                <?php

                  if($row2["usersName"] == "pako"){
                    echo '<h4 style="text-align:left;">NEW PLAYLIST</h4>';
                    echo '<iframe style="border-radius:10px" src="https://open.spotify.com/embed/playlist/4Mr0yAr6zUTtGdg5waLtFA?utm_source=generator&theme=0" width="100%" height="300px" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe><br><br>';
                  }

                  displayPostsUser($conn, $row2["usersName"]);
                ?>
      </div>
      </section> 
    </section>
  <div id="app"></div>
  <script src="profile.js"></script>
  <p style="display:none;">
  <script type="text/javascript">
    showFavs('<?php echo displayUserSneakers($conn, $row2["usersName"]) ?>');
  </script>
  </p>
</body>
</html>
