<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sneaker Archive</title>
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
          session_start();
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
  <section class="container">
    <section class="signup">
        <h3>Register:</h3>
        <form action="includes/signup.inc.php" method="post">
            <p>Username:</p>
            <input type="text" name="username" method="post" placeholder="Username"/>
            <p>Email:</p>
            <input type="email" name="email" method="post" placeholder="E-mail"/>
            <p>Password:</p>
            <input type="password" name="pwd" method="post" placeholder="Password"/>
            <p>Confirm password:</p>
            <input type="password" name="cpwd" method="post" placeholder="Confirm password"/>
            <p style="color: red;">
            <?php
            if (isset($_SESSION['message']))
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            </p>
            <button class="random-btn" type="submit" name="submit">Sign up</button>
        </form>
        <p style="text-align:center;">Already have an account? <a href="login.php">Log in!</a></p>
    </section>
  </section>
  <div id="app"></div>
  <script src="archive.js"></script>
</body>
</html>
