<?php session_start(); ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Forum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="accueil.css">

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
            text-align: center;
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
                resize: none;
        }
        .profilPic{
          width: 127px;height: 127px;
          border: 2px solid limegreen;
          border-radius: 100%;margin: 5px;
          padding: 2px; background-color: limegreen;
        }
        .btnLogout{
          margin-top: 10px;
          float: right;
        }
        .blocInfo{
          line-height: 35px;font-size: 17px;
          width: 382px;margin: auto;padding: 13px;
          background: #286090;color: white;
          border-radius: 55px;
        }
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

                    <?php
                     ?> <li><a class='link' href="user_page.php"> <?php echo $_SESSION['id']; ?></a></li>

                </ul>
                            <a class=' btn btn-success link btnLogout' href="log_out.php">DISCONNECT</a>
            </div>

        </nav>

<div id="main-container" class="container">
<br><br>


  <img class='profilPic'  height="50px" width="50px"  src="<?php echo $_SESSION['avatar'];  ?>" alt=""><br/>

          <div class='blocInfo'>
          <?php
          $user =  $_SESSION['id'];


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



          $sql = "SELECT * FROM users WHERE id = '$user'";


          $result = mysqli_query($conn, $sql);



          if (mysqli_num_rows($result) > 0 ) {
              while($row = mysqli_fetch_assoc($result)){
                echo $row['id']."<br/>";
                echo $row['email'];
              }
        }

        $sql =  "SELECT count(*) as num FROM message WHERE user_id = '$user'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0 ) {
            while($row = mysqli_fetch_assoc($result)){
              echo " <br> number of messages : ".$row['num'];
            }
          }

          $sql =  "SELECT count(*) as num FROM forum WHERE creator = '$user'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0 ) {
              while($row = mysqli_fetch_assoc($result)){
                echo " <br> number of forums : ".$row['num'];
              }
            }



           ?>
         </div>
           <br/>
           <a class='btn btn-primary link' href="change_photo.php"> Change photo</a>
           <a class='btn btn-primary' href="add_subject.php"> Add new forum</a>
           <a class='btn btn-primary' href="my_subjects.php"> Retrieve subjects</a>
           <a class='btn btn-primary' href="delete_forum.php"> Delete forums</a>

        </div>

  </body>
</html>
