<?php session_start();



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="accueil.css">
  </head>
  <body>

    <header>
      <ul>
        <li>
            <a href="accueil.php"> <img class="logo_accueil" height="50" width="50" src="logo.png" alt="logo" > </a>
        </li>




          <li class="li_menu"> <a href="accueil.php"> Home </a> </li>
          <li class="li_menu"> <a href="accueil.php">Movie </a> </li>
          <li class="li_menu"> <a href="accueil.php">Series </a> </li>
          <li class="li_menu"> <a href="forum.php">Forum</a> </li>



      <div class="search">
        <form action="search.php" method="post">
          <input class="text_input" type="text" name="search" >
          <button id = "search_button" type="submit" name="add">Search</button>
        </form>
      </div>
      <?php if (isset($_SESSION['id'])  && isset($_SESSION['passwd']) ){
       ?> <li><a class='link' href="user_page.php"> <img  height="50px" width="50px"  src="<?php echo $_SESSION['avatar'];  ?>" alt="">  <?php echo $_SESSION['id']; ?></a></li>

       <?php
      }
      else {
       ?><li><a class='link' href="login.php">Login/Subscribe</a></li> <?php
      }

      ?>
    </ul>



    </header>
    <div class="bloc">
      <p>Hello mister.</p>

    </div>
    <div class="bloc fond">
      <p>Hello mister.</p>

    </div>
    <div class="bloc">
      <p>Hello mister.</p>

    </div>
    <footer>Yanso & Adri © Copyright 2018</footer>
  </body>
</html>
