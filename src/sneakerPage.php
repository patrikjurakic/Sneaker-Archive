<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reviews</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="icon" type="image/x-icon" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
  

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
  <div class="modal-overlay">
    <div class="modal-container"> 
      <img src="" alt="" id="modal-img">
      <i class="fa-sharp fa-solid fa-caret-left" id="arrowleft"></i>
      <i class="fa-sharp fa-solid fa-caret-right" id="arrowright"></i>
    </div>
  </div>
  <section class="container-sneaker animate__animated animate__fadeInRightBig" id="titleDiv">
    <i class="fa-solid fa-heart fav" id="favbtn"></i>
  </section>
  <div id="app"></div>
  <script src="sneakerPage.js"></script>
</body>
</html>
