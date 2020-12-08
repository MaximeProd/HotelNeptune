<?php
session_start();
require '../Fonctions.php';

$bdd = getDataBase();
$_SESSION['savePostRegister'] = $_POST;
if (isset($bdd)){
    $insert = Array();

    if (isset($_POST)){


        if ($_POST['mdp'] == $_POST['confirmMdp']) {

            $nom = getListe($bdd,'etudiant',Array('nom' => $_POST['nom']),Array(),'nom');
            if (!empty($nom)) {
                $_SESSION["erreur"] = 5;
            }
        } else {
            $_SESSION["erreur"] = 2;
        }
    }
    if (!isset($_SESSION["erreur"])) {
        //Cryptage mdp :
        $_POST['mdp'] = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
        unset($_POST['confirmMdp']);
        insertListe($bdd,'etudiant',$_POST);
        unset($_SESSION['savePostRegister']);
        $listeNouveauEtudiant = getListe($bdd,'etudiant',Array('nom' => $_POST['nom']),Array(),'id');
        $listeNouveauEtudiant = $listeNouveauEtudiant[0];
        $_SESSION['id'] = $listeNouveauEtudiant->id;
        header('Location: ../MonCompte.php');
    } else {
        header('Location: ../Inscriptions.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../Inscriptions.php');
}

