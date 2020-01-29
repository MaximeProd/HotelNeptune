<?php
require 'paterns/Head.php';
//Partie code

$erreur = '';

if (isset($_SESSION["erreur"])){
    $valueErreur = $_SESSION["erreur"];
    if ($valueErreur  == 1){
        $erreur = 'Veuillez contacter l\'administrateur dès les plus bref délai!!';
    } elseif ($valueErreur  == 2) {
        $erreur = 'Mot de passe ou email incorrect';
    } elseif ($valueErreur  == 3) {
        $erreur = 'Email incorrect';
    } elseif ($valueErreur  == 4) {
        $erreur = 'Les mots de passe ne corresponde pas';
    } elseif ($valueErreur  == 5) {
        $erreur = 'Email déjà utilisé';
    } /*elseif ($valueErreur  == 6) {
        $erreur = 'Champ obligatoire incomplet';
    }*/
    unset($_SESSION["erreur"]);

}

if (!isset($_SESSION['savePostRegister']) || empty($_SESSION['savePostRegister'])){
    $savePostRegister =array ("email"=>"","mdp"=>"","confirmMdp"=>"","nom"=>"","prenom"=>"","adresse"=>"","ville"=>"","codePostal"=>"");
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



/* Projet arrêter : objectif automatié la génration des inputs
//On récupe les caractéristique des colonnes
$select = $bdd->query('DESCRIBE membres');
$columns = $select->fetchAll();
//On en extrait les valeur utilies pour leurs complétion tel que la taille max ou leur nom
foreach ($columns as $column) {
    $sizeColumn[$column["Field"]] = extractFromParenthese($column["Type"]);
}

*/




echo '</div>
    <p>'.$erreur.'</p>
      <div class="LoginRegister">
        <link rel="stylesheet" href="../css/LoginRegister.css">
        <form class="Login" action="loginRegister/Login.php" method="post">
          <p>Déja inscrit?</p>
          <input value="'.$savePostLogin["email"].'" type="email"    name="email" value="" placeholder="email"        required="required">
          <input value="'.$savePostLogin["mdp"].'"   type="password" name="mdp"   value="" placeholder="Mot de passe" required="required">
          <input id="Connexion" type="submit" name="" value="Connexion">
        </form>
        <hr>
        <form class="Register" action="loginRegister/Register.php" method="post">
          <p>Créer un nouveau compte</p>
          <input value="'.$savePostRegister["email"].'"      type="email" name="email"           placeholder="Email"          maxlength="250"                              required="required">
          <input value="'.$savePostRegister["mdp"].'"        type="password" name="mdp"          placeholder="Mot de passe"            maxlength="16"     minlength="4"    required="required">
          <input value="'.$savePostRegister["confirmMdp"].'" type="password" name="confirmMdp"   placeholder="Confirmer mot de passe"  maxlength="16"     minlength="4"    required="required">
          <input value="'.$savePostRegister["nom"].'"        type="text" name="nom"              placeholder="Nom"            maxlength="100" minlength="3"                required="required">
          <input value="'.$savePostRegister["prenom"].'"     type="text" name="prenom"           placeholder="Prénom"         maxlength="70"  minlength="3"                required="required">
          <input value="'.$savePostRegister["adresse"].'"    type="text" name="adresse"          placeholder="Adresse"        maxlength="200">
          <input value="'.$savePostRegister["ville"].'"      type="text" name="ville"            placeholder="Ville"          maxlength="200">
          <input value="'.$savePostRegister["codePostal"].'" type="text" name="codePostal"       placeholder="Code postal"    maxlength="10">
          <input id="Enregistrer" type="submit" name="" value="S\'enregistrer">
        </form>
      </div>';


//var_dump($_POST);
//$hack = md5('Bonsoir');
//var_dump($hack);
//Fin partie code
require 'paterns/Foot.php';
?>