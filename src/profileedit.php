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
  <section class="container animate__animated animate__fadeInRightBig">
    <section class="signup">
        <h3>Edit your profile:</h3>
        <form action="includes/replace.inc.php" method="post" >
            <p>Username:</p>
            <input type="text" value="<?php echo $_SESSION["username"]; ?>" name="username" method="post" placeholder="Username"/>
            <p>Description:</p>
            <input type="text" value="<?php echo $_SESSION["userinfo"]; ?>" name="userinfo" method="post" placeholder="Info"/>
            <p>Profile picture url:</p>
            <input type="text" value="<?php echo $_SESSION["userimg"]; ?>" name="userimg" method="post" placeholder="Image url"/>

            <button class="random-btn" type="submit" name="submit">Save</button>
        </form>
  <div id="app"></div>
  <script src="profile.js"></script>
</body>
</html>
