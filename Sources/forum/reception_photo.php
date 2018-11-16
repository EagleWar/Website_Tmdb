<?php
session_start();

if ($_FILES['icone']['error'] > 0) {


  ?>
  <script type="text/javascript">
    alert("Error in uploading the file");
  </script>
  <meta http-equiv="refresh" content="0; change_photo.php " /><?php

  # code...
}


$nom =   "avatar/avatar_".$_SESSION['id'].".png";



$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tuto";

$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);

if ($resultat){

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $session = $_SESSION['id'];

  $sql = "UPDATE users SET image= '$nom' WHERE `id`= '$session'";



  if (mysqli_query($conn, $sql)) {

      ?><meta http-equiv="refresh" content="0; user_page.php " /><?php

  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }




}
 ?>
