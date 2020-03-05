<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset ($bdd)) {
    $password = htmlspecialchars($_POST['mdp']);
    $liste = getListe($bdd,'membres',Array("id" => $_SESSION['idClient']),Array(),'mdp');
    if (password_verify($password, $liste[0]->mdp)) {
        if ($_POST['newMdp'] == $_POST['confMdp']){
            $encryptMdp = password_hash($_POST['newMdp'],PASSWORD_DEFAULT);
            updateListe($bdd,'membres',Array("mdp" => $encryptMdp),"id=".$_SESSION["idClient"]);
            $_SESSION["erreur"] = "Mot de passe modifié avec succés";
            header('Location: ../MonCompte.php');
        }
        else{
            $_SESSION["erreur"] = 4;
            header('Location: ../MonCompte.php');
        }
    } else {
        $_SESSION["erreur"] = "Mot de passe incorrect";
        header('Location: ../MonCompte.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../index.php');
}

