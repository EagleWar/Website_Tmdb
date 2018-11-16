<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Change photo</title>
  </head>
  <body>

  </body>
</html>


<form method="post" action="reception_photo.php" enctype="multipart/form-data">
     <label for="icone">Icône du fichier (JPG, PNG ou GIF | max. 15 Ko) :</label><br />
     <input type="file" name="icone" id="icone" /><br />
     <input type="submit" name="submit" value="Envoyer" />
</form>


<?php


 ?>
