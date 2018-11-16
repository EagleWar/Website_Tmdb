<?php session_start(); ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Forum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="search_forum.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projet PHP</title>

    <!-- Bootstrap CSS  -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- Inline CSS -->

    <style type="text/css">
        body {
            background-color: #B1B1B1;
        }

        #main-container {
            background-color: #F1F1F1;
            min-height: 550px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            padding-top: 60px;

        }

        #page-title {
            margin-top: 0px;
        }
        .col{display: inline-block;margin: 22px;}
        .titre{width: 220px; text-align: center;}
        .cadre{margin: auto;text-align: center;}
        .hide{display: none;}
        .formTop{display: inline-block;}

        /*FORM LEFT*/
        .formLeft{text-align: center; }
        .titreFormLeft{margin-top: 40px;text-align: center;}
        .overview{width: 100%;

                padding: 12px 20px;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
                resize: none;}
    </style>



  </head>
  <body>




    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/Projet_HTML/index.php">Projet PHP</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">




                     <li>

                        <a class='link' href="/Projet_HTML/index.php"> Home</a>
                    </li>

                    <?php if (isset($_SESSION['id'])  && isset($_SESSION['passwd']) ){
                     ?> <li><a class='link' href="user_page.php">   <?php echo $_SESSION['id']; ?></a></li>

                     <?php
                    }
                    else {
                     ?><li><a class='link' href="login.php">Login/Subscribe</a></li> <?php
                    }

                    ?>




                </ul>
                <ul class="nav navbar-nav navbar-right">
                        <form class="formTop" method="get" action="forum.php">
                         <input  placeholder="Search..." style="margin-top: 13px;width:200px; background: transparent;border:0; border-bottom: 2px solid black;  " type="text" name="title">
                         <input class="hide" type="submit" name="add">

                        </form>
                    </ul>





            </div>
        </nav>



        <div id="main-container" class="container">

<br>



<?php




$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "TUTO";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}


$search = $_GET["forum_id"];

$sql = "SELECT image,message.user_id, message.message, message.date FROM message
join forum on forum.id_forum = message.forum_id
join users on users.id = message.user_id
where message.forum_id = '$search'
order by message.date desc
";

$result = mysqli_query($conn, $sql);


$i=0;
$class = "";

$title = "SELECT title FROM forum WHERE id_forum = '$search'";
$result_title = mysqli_query($conn, $title);



if (mysqli_num_rows($result) > 0 ) {

      $mytitle = mysqli_fetch_assoc($result_title);

      ?> <h1 style="text-align:center;"> <?php echo $mytitle["title"]; ?> </h1>  <?php



        while($row = mysqli_fetch_assoc($result)){
          if ($i%2==0) {
            $class = "message_bloc1";
          }
          else {
            $class = "message_bloc2";
          }
          $i++;
          ?>


  <div class=" <?php echo $class ?> ">

    <div class="user_info">
      <img height="50" width="50" src=" <?php    echo  $row["image"]; ?> " alt="">
      <br>
      <span class="user"><?php   echo "" . $row["user_id"] . "<br>"; ?></span>

    </div>
    <div class="message_bloc">
    <?php echo "date : " . $row["date"]. "<br> <br> "; ?>
    <?php   echo "message : " . $row["message"]. "<br>"; ?>


    </div>


  </div>

                    <?php

      }
}


mysqli_close($conn);



 ?>







    <form style="text-align:center;padding:10;" method="post" action=" <?php echo "add_message.php?forum_id=".$_GET['forum_id']?>">
      Comment: <textarea name="message" rows="5" cols="40"></textarea>
      <br><br>
      <input type="submit" name="submit" value="Submit">
    </form>

</div>

  </body>
</html>
