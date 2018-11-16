<?php session_start();


$id = $_POST['id'];
$passwd = $_POST['passwd'];



$_SESSION['id'] = htmlspecialchars($id);
$_SESSION['passwd'] = sha1(htmlspecialchars($passwd));


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

$session = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id='$session'  ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $temp = sha1(htmlspecialchars($row["passwd"]));
        if ($temp == $_SESSION['passwd']) {
        
          ?>
          <meta http-equiv="refresh" content="0; /Projet_HTML/index.php" />
          <?php

          $_SESSION['avatar'] = $row["image"];
        }
        else {
          unset($_SESSION['id']);
          unset($_SESSION['passwd']);
            unset($_SESSION['image']);

          ?>
           <meta http-equiv="refresh" content="0; login.php" />
           <script type="text/javascript">
             alert("Mots de passe incorrect");
           </script>
        <?php
        }
}
else {
  unset($_SESSION['id']);
  unset($_SESSION['passwd']);
    unset($_SESSION['image']);
  ?>
   <meta http-equiv="refresh" content="0; login.php" />
   <script type="text/javascript">
      alert("Incorrect log in");
   </script>
<?php

}

mysqli_close($conn);



?>
