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
                        <form class="formTop" method="get" action="<?php $_SERVER['PHP_SELF']?>">
                         <input  placeholder="Search..." style="margin-top: 13px;width:200px; background: transparent;border:0; border-bottom: 2px solid black;  " type="text" name="title">
                         <input class="hide" type="submit" name="add">

                        </form>
                    </ul>





            </div>
        </nav>



        <div id="main-container" class="container">

<br>

      <?php   $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "TUTO";

        $user = $_SESSION['id'];

        $row_per_page = 4;

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
        }

        if (isset( $_GET['page'])) {
            $begin = $_GET['page'];
            $begin = ($begin * $row_per_page);
        }
        else {
          $begin = 0;
        }





        ?>  <h1>My subjects</h1>  <?php


        $sql_rows = "SELECT * FROM forum WHERE creator = '$user'";
        $result = mysqli_query($conn, $sql_rows);
        $num_rows = mysqli_num_rows($result);

        if (($begin+$row_per_page) > $num_rows) {

          $row_max = $row_per_page;
          while (($begin+$row_max) > $num_rows) {
            $row_max = $row_max -1;
          }

        }
        else {
          $row_max = $row_per_page;
        }

        $sql = "SELECT * FROM forum WHERE creator = '$user' LIMIT $begin, $row_max ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0 ) {
                while($row = mysqli_fetch_assoc($result)){

                ?>
                      <div style="margin:auto;"class="row">
                          <table>
                            <tr>
                              <td class="title" ><a href="<?php echo "search_forum.php?forum_id=".$row["id_forum"]?>" >
                                <?php   echo "title  : " . $row["title"]; ?>   </a></td>
                              <td class="forum_id"><?php echo "id: ".$row["id_forum"]; ?> </td>
                              <td class="date"> <?php  echo "date". $row["date"];?> </td>

                            </tr>
                          </table>
                      </div>
                <?php
              }
        }



      if ($num_rows > $row_per_page) {
        $number_pages=ceil($num_rows/$row_per_page);

        ?>
        <div class="pagination">
        <?php

        for ($i=0; $i <$number_pages ; $i++) {

        ?>   <a href="my_subjects.php?page=<?php echo "$i";?>"> <?php echo "$i";?></a> <?php

        }
         ?>
          </div>
        <?php

      }

      mysqli_close($conn);
      ?>




</div>

  </body>
</html>
