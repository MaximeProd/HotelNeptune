<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset ($bdd)) {
    $password = htmlspecialchars($_POST['mdp']);
    $liste = getListe($bdd,'membres',Array("id" => $_SESSION['idClient']),Array(),'mdp');
    if (count($liste) == 1 && password_verify($password, $liste[0]->mdp)) {
        if ($_POST['newMdp'] == $_POST['confMdp']){
            $_POST['mdp'] = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
            updateListe($bdd,'membres',Array("mdp" => $_POST['mdp']),$_SESSION["idClient"]);
        }
        else{
            $_SESSION["erreur"] = 4;
        }
    } else {
        $_SESSION["erreur"] = 4;
    }
} else {
    $_SESSION["erreur"] = 7;
}
