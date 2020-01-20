<?php
require 'paterns/Head.php';
//Partie code

echo '<div class="LoginRegister">
        <link rel="stylesheet" href="../css/LoginRegister.css">
        <form class="Login" action="loginRegister/Login.php" method="post">
          <input type="text" name="username" value="" placeholder="Nom d\'utilisateur">
          <input type="text" name="mdp" value="" placeholder="Mot de passe">
          <input type="submit" name="" value="Connexion">
        </form>
        <form class="Register" action="loginRegister/Register.php" method="post">
          <input type="text" name="username" value="" placeholder="Nom d\'utilisateur">
          <input type="text" name="mdp" value="" placeholder="Mot de passe">
          <input type="text" name="confirmMdp" value="" placeholder="Confirmer mot de passe">
          <input type="submit" name="" value="S\'enregistrer">
        </form>
      </div>';

//var_dump($_POST);
//$hack = md5('Bonsoir');
//var_dump($hack);
//Fin partie code
?>