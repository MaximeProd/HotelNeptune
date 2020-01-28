<?php
//Une variable $idClient est disponible à chaque page.
require 'paterns/Head.php';
require "Fonctions.php";
//Partie code
$bdd = getDataBase();
$membre = getListe($bdd,"membres", array("id"=>$idClient));
$membre = $membre[0];

echo '<link rel="stylesheet" href="../css/MonCompte.css">
                <div class="cadre">
          <div class="bandeau">
            <h3>Mon Compte</h3>
            <div class="formulaire">
              <h4>Informations personnels</h4>
              <hr>
              <form class="" action="index.html" method="post">
                <label for="Nom">Nom</label><input type="text" name="Nom" value="" placeholder="Nom">
                <label for="Prénom">Prénom</label><input type="text" name="Prénom" value="" placeholder="Prénom">
                <label for="Adresse">Adresse</label><input type="text" name="Adresse" value="" placeholder="Adresse">
                <label for="Ville">Ville</label><input type="text" name="Ville" value="" placeholder="Ville">
                <label for="Code postal">Code postal</label><input type="text" name="Code postal" value="" placeholder="Code postal">
                <input id="Modif" type="submit" name="" value="Modifier son compte">
              </form>
            </div>
            <div class="formulaire">
              <h4>Modifier mot de passe</h4>
              <hr>
              <form class="" action="index.html" method="post">
                <label for="Mot de passe">Mot de passe</label><input type="text" name="Mot de passe" value="" placeholder="Mot de passe">
                <label for="Nouveau mot de passe">Nouveau mot de passe</label><input type="text" name="Nouveau mot de passe" value="" placeholder="Nouveau mot de passe">
                <label for="Comfirmer mot de passe">Comfirmer mot de passe</label><input type="text" name="Comfirmer mot de passe" value="" placeholder="Comfirmer mot de passe">
                <input id="Mdp" type="submit" name="" value="Modifier mot de passe">
              </form>
            </div>
            <div class="formulaire">
              <h4>Supprimer son compte</h4>
              <hr>
              <form class="" action="index.html" method="post">
                <label for="Mot de passe">Mot de passe</label><input type="text" name="Mot de passe" value="" placeholder="Mot de passe">
                <input id="Supr" type="submit" name="" value="Supprimer">
              </form>
            </div>
            <input id="Deco" type="submit" name="" value="Se déconnecter">
          </div>
        </div>';





echo '
<form class="Register" action="loginRegister/Logout.php" method="post">
    <input type="submit" name="" value="Se déconnecter">
</form>
       ';



?>