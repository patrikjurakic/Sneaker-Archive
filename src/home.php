<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sneaker Archive - Home</title>
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
            echo "<a href='login.php'>Login</a>";
          }
        ?>
        </li>
      </ul>
    </div>
  </nav>
  <main>
    <section>
      <div class="title">
        <h2 class="animate__animated animate__fadeInDownBig">Home</h2>
        <div class="underline">
        </div>
      </div>
    </section>
  </main>
  <header class="hero animate__animated animate__fadeInRightBig">
      <div class="banner">
        <?php
          if(isset($_SESSION["userid"])){
            echo "<img src='". $_SESSION["userimg"] ."'>";
            if(isset($_SESSION["verified"])){
              echo "<h1 class='verified'>Welcome, ". $_SESSION["username"] ."<i class='fa-solid fa-circle-check' style='--fa-animation-duration: 1s;  position: relative; top: -1em; left: 0.5em; font-size: 40%; color:#7bdff2;'></i> </h1>";
            }
            else{
              echo "<h1>Welcome, ". $_SESSION["username"] ."</h1>";
            }
            echo "<a href='profile.php'>Your profile</a><br><br>";
          }
          else{
            echo "<h2>You are not logged in.</h2>";
          }
        ?>
      </div>
  </header>
  <section class="container">
    <div class="title">
      <h2>Feed:</h2>
      <?php
      if (isset($_SESSION["username"])){
        echo '<a href="createpost.php" style="font-size:30px;"><i class="fa-solid fa-circle-plus addpost"></i></a>';
      }
      ?>
      <?php
        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';
        displayPosts($conn);
      ?></div><br>
    <h3>Go to <a href="archive.php">sneaker archive</a></h3>
  </section>
  <div id="app"></div>
  <script src="home.js"></script>
</body>
</html>
