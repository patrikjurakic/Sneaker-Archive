<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sneaker Archive - Create Post</title>
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
        <img src="./sneaker.archive.png" class="" alt="">
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
  <section class="container animate__animated animate__fadeInRightBig">
    <section class="signup post">
        <h3>Create a new post:</h3>
        <?php
                if(isset($_SESSION["userid"])){
                    echo "<img  src='" . $_SESSION["userimg"] . "'>";
                    if(isset($_SESSION["verified"])){
                      echo "<h4 class='verified'>". $_SESSION["username"] ."<i class='fa-solid fa-circle-check' style='--fa-animation-duration: 1s;  position: relative; top: -1em; left: 0.5em; font-size: 40%; color:#7bdff2;'></i> </h4>";
                    }
                    else{
                      echo "<h4 style='font-weight: bold;'>". $_SESSION["username"] ."</h4>";
                    }
                }
        ?>
        <form action="includes/post.inc.php" method="post" id="postform">
            <p>Title:</p>
            <input type="text" name="title" method="post" placeholder="Post title"/>
            <p>Text:</p>
            <textarea name="text" form="postform" method="post" name="text" placeholder="Enter your text..."></textarea>
            <p>Image url (optional):</p>
            <input type="text" name="img" method="post" placeholder="Paste image url"/>
            <button class="random-btn" type="submit" method="post" name="submit">Post</button>
        </form>
    </section>
  </section>
  <div id="app"></div>
  <script src="archive.js"></script>
</body>
</html>
