<?php
//Une variable $idClient est disponible à chaque page.
require 'paterns/Head.php';
require "Fonction.php";
//Partie code
$bdd = getDataBase();
$membre = getListe($bdd,"membres", array("id"=>$idClient));
$membre = $membre[0];

echo '
        <div class="cadre">
          <div class="bandeau">
            <p>Mon Compte</p>
            <div class="formulaire">
              <form class="" action="index.html" method="post">
                <label for="Nom">Nom</label><input type="text" name="Nom" value= "'. $membre -> nom . '" placeholder="Nom">
                <label for="Prénom">Prénom</label><input type="text" name="Prénom" value="'. $membre -> prenom . '" placeholder="Prénom">
                <label for="Adresse">Adresse</label><input type="text" name="Adresse" value="'. $membre -> adresse . '" placeholder="Adresse">
                <label for="Ville">Ville</label><input type="text" name="Ville" value="'. $membre -> ville . '" placeholder="Ville">
                <label for="Code postal">Code postal</label><input type="text" name="Code postal" value="'. $membre -> codePostal . '" placeholder="Code postal">
              </form>
            </div>
          <input id="Modif" type="submit" name="" value="Modifier son compte">
          <input id="Supr" type="submit" name="" value="Supprimer">
          <input id="Deco" type="submit" name="" value="Se déconnecter">
          </div>
        </div>';





echo '
<form class="Register" action="loginRegister/Logout.php" method="post">
    <input type="submit" name="" value="Se déconnecter">
</form>
       ';



?>