<?php
require 'paterns/Head.php';
//Partie code
//Gestion des erreurs

//Completion des listes pour les éviter les erreurs si elle sont vide
if (!isset($_SESSION['savePostRegister']) || empty($_SESSION['savePostRegister'])){
    $savePostRegister = array ("email"=>"","mdp"=>"","confirmMdp"=>"","nom"=>"","prenom"=>"","adresse"=>"","ville"=>"","codePostal"=>"");
} else {
    $savePostRegister = $_SESSION['savePostRegister'];
    unset($_SESSION['savePostRegister']);
}
if (!isset($_SESSION['savePostLogin']) || empty($_SESSION['savePostLogin'])){
    $savePostLogin = array ("email"=>"","mdp"=>"");
} else {
    $savePostLogin = $_SESSION['savePostLogin'];
    unset($_SESSION['savePostLogin']);
}



echo '</div>
      <div class="LoginRegister">
        <link rel="stylesheet" href="../css/LoginRegister.css">
        <form class="Login" action="loginRegister/Login.php" method="post">
          <p>Déja inscrit?</p>
          <input value="'.$savePostLogin["nom"].'" type="email"    name="email" value="" placeholder="email"        required="required">
          <input value="'.$savePostLogin["prénom"].'" type="email"    name="email" value="" placeholder="email"        required="required">
          <input value="'.$savePostLogin["mdp"].'"   type="password" name="mdp"   value="" placeholder="Mot de passe" required="required">
          <input id="Connexion" type="submit" name="" value="Connexion">
        </form>
        <hr>
        <form class="Register" action="loginRegister/Register.php" method="post">
          <p>Créer un nouveau compte</p>
        
          <input value="'.$savePostRegister["mdp"].'"        type="password" name="mdp"          placeholder="Mot de passe"            maxlength="16"     minlength="4"    required="required">
          <input value="'.$savePostRegister["confirmMdp"].'" type="password" name="confirmMdp"   placeholder="Confirmer mot de passe"  maxlength="16"     minlength="4"    required="required">
          <input value="'.$savePostRegister["nom"].'"        type="text" name="nom"              placeholder="Nom"            maxlength="100" minlength="3"                required="required">
          <input value="'.$savePostRegister["prenom"].'"     type="text" name="prenom"           placeholder="Prénom"         maxlength="70"  minlength="3"                required="required">
          <p>Civilité</p> 
          <div class="civilite"><label for="Monsieur">Monsieur</label>
          <input value="Monsieur" checked                    type="radio" name="civilite">
          <label for="Madame">Madame</label>
          <input value="Madame"                              type="radio"         name="civilite"></div>         
          <input id="Enregistrer" type="submit" name="" value="S\'enregistrer">
        </form>
      </div>';

