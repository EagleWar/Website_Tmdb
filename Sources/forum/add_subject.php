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
                     ?> <li><a class='link' href="user_page.php">  <?php echo $_SESSION['id']; ?></a></li>

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
<h3>Add New Subject</h3>


<?php if (!isset($_SESSION['id'])) {
  ?> <meta http-equiv="refresh" content="0; login.php" />   <?php
} ?>

    <form method="post" action="add_subject.php">
      Title : <input type="text" name="title">
      <br><br>
      <input type="submit" name="submit" value="Submit">
    </form>



    <?php

    if (isset($_POST['submit']) && isset($_POST['title'])) {

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "tuto";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $user = $_SESSION["id"];
        $title = $_POST["title"];





        $sql = "INSERT INTO forum (title, date,creator )
        VALUES ('$title', NOW(),'$user')";

        if($title != ""){
          if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
              ?><meta http-equiv="refresh" content="0; forum.php " /><?php

          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }


        }
        else {
          ?>   <script type="text/javascript">
            alert("Message Vide");
          </script>  <meta http-equiv="refresh" content="0; forum.php " /><?php
        }





        mysqli_close($conn);
    }
     ?>


</div>

  </body>
</html>
