<?php
session_start();


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


    foreach($_POST['checkbox'] as $del)
    {

      $sql = "DELETE FROM message WHERE forum_id='$del'";
      if ( mysqli_query($conn, $sql)) {
        echo "rows deleted";
      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        $error = "impossible to delete";
      }

      $sql = "DELETE FROM forum WHERE id_forum='$del'";


      if (mysqli_query($conn, $sql)) {
        echo "row deleted";
      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        $error = "impossible to delete";
      }

    }

    ?>  <meta http-equiv="refresh" content="0; delete_forum.php" /> <?php




 ?>
