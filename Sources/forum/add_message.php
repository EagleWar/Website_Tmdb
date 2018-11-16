<?php
session_start();

?>

<?php if(!isset($_SESSION['id'])) {

  ?>
  <script type="text/javascript">
    alert("you have to log in");
  </script>
  <meta http-equiv="refresh" content="0; login.php" />   <?php
}




  if (isset($_POST['submit']) && isset($_POST['message']) && isset($_SESSION['id'])) {




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

      $forum_id = $_GET["forum_id"];
      $user = $_SESSION["id"];
      $message = $_POST["message"];

      $message = mysqli_real_escape_string($conn, $message);

      echo "user : ".$user."<br>";
      echo "$message"."<br>";
      echo "forum_id".$forum_id."<br>";

      $message = str_replace("\n", "<br/>", $message);

      $sql = "INSERT INTO message (forum_id, user_id, message, date )
      VALUES ('$forum_id', '$user', '$message', NOW())";

      if($message != ""){
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            ?><meta http-equiv="refresh" content="0; <?php echo"search_forum.php?forum_id=".$forum_id; ?> " /><?php

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


      }
      else {
        ?><meta http-equiv="refresh" content="0; <?php echo"search_forum.php?forum_id=".$forum_id; ?> " /><?php
      }





      mysqli_close($conn);
  }

  # code...



 ?>
