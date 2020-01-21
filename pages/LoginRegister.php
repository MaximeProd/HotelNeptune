<?php
require 'paterns/Head.php';
//Partie code

echo '</div>
      <div class="LoginRegister">
        <link rel="stylesheet" href="../css/LoginRegister.css">
        <form class="Login" action="Login.php" method="post">
          <p>Déja inscrit?</p>
          <input type="text" name="email" value="" placeholder="Email">
          <input type="text" name="mdp" value="" placeholder="Mot de passe">
          <input id="Connexion" type="submit" name="" value="Connexion">
        </form>
        <hr>
        <form class="Register" action="Register.php" method="post">
          <p>Créer un nouveau compte</p>
          <input type="text" name="email" value="" placeholder="Email">
          <input type="text" name="mdp" value="" placeholder="Mot de passe">
          <input type="text" name="confirmMdp" value="" placeholder="Confirmer mot de passe">
          <input type="text" name="Nom" value="" placeholder="Nom">
          <input type="text" name="Prénom" value="" placeholder="Prénom">
          <input type="text" name="Adresse" value="" placeholder="Adresse">
          <input type="text" name="Ville" value="" placeholder="Ville">
          <input type="text" name="Code postal" value="" placeholder="Code postal">
          <input id="Enregistrer" type="submit" name="" value="S\'enregistrer">
        </form>
      </div>';

//var_dump($_POST);
//$hack = md5('Bonsoir');
//var_dump($hack);
//Fin partie code
?>