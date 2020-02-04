<?php
//Une variable $idClient est disponible à chaque page.
require 'paterns/Head.php';

//Partie code
$bdd = getDataBase();
$membre = getListe($bdd,"membres", array("id"=>$idClient));

//var_dump($idClient);
//var_dump($membre);
$membre = $membre[0];

echo '<link rel="stylesheet" href="../css/MonCompte.css">
          <div class="cadre">
          <div class="bandeau">
            <h3>Mon Compte</h3>
            <div class="formulaire">
              <h4>Informations personnels</h4>
              <hr>
              <form class="" action="loginRegister/Update.php" method="post">
                  <label for="civilite">Civilité</label>       <input type="hidden"name="civilite"  value="'.$membre->civilite.'"       placeholder="Nom"            maxlength="100" minlength="3">
                  <label for="nom">Nom</label>                 <input type="text" name="nom"        value="'.$membre->nom.'"            placeholder="Nom"            maxlength="100" minlength="3">
                  <label for="prenom">Prénom</label>           <input type="text" name="prenom"     value="'.$membre->prenom.'"         placeholder="Prénom"         maxlength="70"  minlength="3" >
                  <label for="adresse">Adresse</label>         <input type="text" name="adresse"    value="'.$membre->adresse.'"        placeholder="Adresse"        maxlength="200">
                  <label for="ville">Ville</label>             <input type="text" name="ville"      value="'.$membre->ville.'"          placeholder="Ville"          maxlength="200">
                  <label for="codePostal">Code postal</label>  <input type="text" name="codePostal" value="'.$membre->codePostal.'"     placeholder="Code postal"    maxlength="10">
                <input id="Modif" type="submit" name="" value="Modifier son compte">
              </form>
            </div>
            <div class="formulaire">
              <h4>Modifier mot de passe</h4>
              <hr>
              <form class="" action="index.html" method="post">
                <label for="Mot de passe">Mot de passe</label>
                <input type="password" name="mdp"          placeholder="Mot de passe"        maxlength="16"     minlength="6">
                <label for="newMdp">Nouveau mot de passe</label>
                <input type="password" name="newMdp"   placeholder="Confirmer mot de passe"  maxlength="16"     minlength="6">
                <label for="confMdp">Comfirmer mot de passe</label>
                <input type="text" name="confMdp" placeholder="Comfirmer mot de passe"       maxlength="16"     minlength="6">
                <input id="Mdp" type="submit" name="confirmMdp" value="Modifier mot de passe">
              </form>
            </div>
            <div class="formulaire">
              <h4>Supprimer son compte</h4>
              <hr>
              <form class="" action="loginRegister/Remove.php" method="post">
                <label for="Mot de passe">Mot de passe</label><input type="text" name="Mot de passe" value="" placeholder="Mot de passe">
                <input id="Supr" type="submit" name="" value="Supprimer">
                <input type="hidden" name="id" value="'.$idClient.'">
              </form>
              <form class="Register" action="loginRegister/Logout.php" method="post">
                <input id="Deco" type="submit" name="" value="Se déconnecter">
              </form>
            </div>
          </div>
        </div>';







require 'paterns/Foot.php';
?>