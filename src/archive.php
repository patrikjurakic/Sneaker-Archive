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
    <div class="title">
      <h2>Sneaker Archive</h2>
      <div class="searchbar button-container">
        <input placeholder="Search sneakers here..." type="text" name="txt" id="searchbar"/>
        <select name="model" id="model">
          <option value = "">Choose a model</option>
          <option value="Jordan 1">Air Jordan 1</option>
          <option value="Jordan 3">Air Jordan 3</option>
          <option value="Jordan 4">Air Jordan 4</option>
          <option value="adidas">Adidas</option>
          <option value="Dunk Low">Nike Dunk Low</option>
          <option value="Air Force">Nike Air Force 1</option>
          <option value="Bape Sta">A Bathing Ape Bape Sta</option>
          <option value="New Balance">New Balance</option>
          <option value="LV">Louis Vuitton LV Trainer</option>
        </select>
        <img src="" alt="" id="logo" class="logo"/>
      </div>
    </div><br>
    <div id="sneaker-cards">

    </div>
  </section>
  <div id="app"></div>
  <script src="archive.js"></script>
</body>
</html>
