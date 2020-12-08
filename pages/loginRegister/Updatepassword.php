<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset ($bdd)) {
    $password = htmlspecialchars($_POST['mdp']);
    $liste = getListe($bdd,'etudiant',Array("id" => $_SESSION['id']));
    if (password_verify($password, $liste[0]->mdp)) {
        if ($_POST['newMdp'] == $_POST['confMdp']){
            $encryptMdp = password_hash($_POST['newMdp'],PASSWORD_DEFAULT);
            updateListe($bdd,'etudiant',Array("mdp" => $encryptMdp),"id=".$_SESSION["id"]);
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

