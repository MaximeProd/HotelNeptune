<?php
require 'paterns/Head.php';
//Partie code

$erreur = '';

if (isset($_SESSION["erreur"])){
    if ($_SESSION["erreur"] == 1){
        $erreur = 'Veuillez contacter l\'administrateur dès les plus bref délai!!';
    } elseif ($_SESSION["erreur"] == 2) {
        $erreur = 'Mot de passe ou email incorrect';
    } elseif ($_SESSION["erreur"] == 3) {
        $erreur = 'Email incorrect';
    }
    unset($_SESSION["erreur"]);
}
echo '</div>
    <p>'.$erreur.'</p>
      <div class="LoginRegister">
        <link rel="stylesheet" href="../css/LoginRegister.css">
        <form class="Login" action="loginRegister/Login.php" method="post">
          <p>Déja inscrit?</p>
          <input type="email"    name="email" value="" placeholder="email">
          <input type="password" name="mdp"   value="" placeholder="Mot de passe">
          <input id="Connexion" type="submit" name="" value="Connexion">
        </form>
        <hr>
        <form class="Register" action="loginRegister/Register.php" method="post">
          <p>Créer un nouveau compte</p>
          <input type="email" name="email"           placeholder="Email"          maxlength="250" >
          <input type="password" name="mdp"          placeholder="Mot de passe"            maxlength="16"     minlength="6">
          <input type="password" name="confirmMdp"   placeholder="Confirmer mot de passe"  maxlength="16"     minlength="6">
          <input type="text" name="nom"              placeholder="Nom"            maxlength="100" minlength="3">
          <input type="text" name="prenom"           placeholder="Prénom"         maxlength="70"  minlength="3" >
          <input type="text" name="adresse"          placeholder="Adresse"        maxlength="200">
          <input type="text" name="ville"            placeholder="Ville"          maxlength="200">
          <input type="text" name="codePostal"       placeholder="Code postal"    maxlength="10">
          <input id="Enregistrer" type="submit" name="" value="S\'enregistrer">
        </form>
      </div>';



//var_dump($_POST);
//$hack = md5('Bonsoir');
//var_dump($hack);
//Fin partie code
require 'paterns/Foot.php';
?>