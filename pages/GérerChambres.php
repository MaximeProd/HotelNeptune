<?php
require 'paterns/Head.php';
//Partie code
echo '
<html>
  <body>
    <form enctype="multipart/form-data" action="loginRegister/InsertImage.php" method="post">
      <label for="image"></label> <input id="image" type="file" name="monfichier" accept="image/png, image/jpeg"/>

      <label for="image">Transfère le fichier</label> <input id="image" type="file" name="monfichier" accept="image/png, image/jpeg"/>
      <input type="submit" />
    </form>
  </body>
</html>
';


require 'paterns/Foot.php';
?>