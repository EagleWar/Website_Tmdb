
<?php




  $nameErr = $emailErr = $passwordErr ="";
  $name = $email = $password =  $password_confirm = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {

      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["username"]);


      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {


      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["password"]) || empty($_POST["password_confirm"])) {
      $passwordErr = "Password is required";
    } else {
      $password = $_POST["password"];
      $password_confirm = $_POST["password_confirm"];
      // check if e-mail address is well-formed
      if ($password != $password_confirm) {
        $passwordErr = "The passwords are differents";
      }
      else if(strlen($password) <4){
        $passwordErr = "The password is too short";
      }

    }



    if($nameErr == "" && $emailErr =="" && $passwordErr ==""){
      $servername = "localhost";
      $username_db = "root";
      $password_db = "root";
      $dbname = "tuto";

      // Create connection
      $conn = mysqli_connect($servername, $username_db, $password_db, $dbname);
      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }



      $sql_name = "SELECT * FROM users WHERE id = '$name'";
      $result = mysqli_query($conn, $sql_name);
      $num_rows = mysqli_num_rows($result);

      $sql_email = "SELECT * FROM users WHERE email = '$email'";
      $result_email = mysqli_query($conn, $sql_email);
      $num_rows2 = mysqli_num_rows($result_email);

      if( $num_rows > 0){
        $nameErr = "Username already exist";
      }
      if( $num_rows2 > 0){
        $emailErr = "Email already exist";
      }
      if($num_rows == 0 && $num_rows2 == 0) {

              $sql = "INSERT INTO users (id, passwd, email )
              VALUES ('$name', '$password', '$email')";


              if (mysqli_query($conn, $sql)) {

                  ?>
                  <script type="text/javascript">
                  alert("Please check your mail to confirm your account");

                  </script>
                  <meta http-equiv="refresh" content="0;/Projet_HTML/index.php"><?php

              } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }
      }
      //$sql = "SELECT count(*) as count FROM users WHERE id = '$email'";





    }
    else {
      echo "donées fausse <br>" ;

      echo "name : ".$nameErr." email : ".$emailErr." passwd : ".$passwordErr;
    }


  # code...
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 ?>








<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>

<div class="container">


    <form class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
      <fieldset>
        <div id="legend">
          <legend class="">Register</legend>
        </div>
        <div class="control-group">
          <!-- Username -->
          <label class="control-label"  for="username">Username</label>
          <div class="controls">
            <input type="text" id="username" name="username" placeholder="" class="input-xlarge"> <?php echo "
            $nameErr"; ?>
            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
          </div>
        </div>

        <div class="control-group">
          <!-- E-mail -->
          <label class="control-label" for="email">E-mail</label>
          <div class="controls">
            <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
            <?php echo "$emailErr"; ?>
            <p class="help-block">Please provide your E-mail</p>
          </div>
        </div>

        <div class="control-group">
          <!-- Password-->
          <label class="control-label" for="password">Password</label>
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="" class="input-xlarge"><?php echo "$passwordErr"; ?>
            <p class="help-block">Password should be at least four caracters</p>
          </div>
        </div>

        <div class="control-group">
          <!-- Password -->
          <label class="control-label"  for="password_confirm">Password (Confirm)</label>
          <div class="controls">
            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge"> <?php echo $passwordErr; ?>
            <p class="help-block">Please confirm password</p>
          </div>
        </div>

        <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <button class="btn btn-success">Register</button>
          </div>
        </div>
      </fieldset>
    </form>
</div>
  </body>
</html>
