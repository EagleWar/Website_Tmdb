

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
  </head>
  <body>









    <div class="login" >
      <div class="logo">
        <a href="/Projet_HTML/index.php" class="logo_accueil"> Home </a>
      </div>

      <form action="check_log.php" method="post">
        <div class="login_form">
          <div class="login_font">
              <h3>Login into your account</h3>
          </div>

          <div class="input_data">
            <label for="id" class="input_data_user"> Id</label>
            <input   type="text" name="id">
            <label for="passwd" class="input_data_passwd"> Password </label>
            <input  type="password" name="passwd">
            <button id = "send_data_button" type="submit" name="add">Login</button>
          </div>



          </div>


        </div>

        <div class="subscribe">
          <a href="subscribe.php">Subscribe</a>

        </div>

      </form>
    </div>


  </body>
</html>
