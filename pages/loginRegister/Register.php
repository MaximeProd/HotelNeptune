<?php
session_start();
require '../Fonctions.php';

$bdd = getDataBase();
$_SESSION['savePostRegister'] = $_POST;
if (isset($bdd)){
    $insert = Array();
    //Partie vérification qu'il n'y est pas d'erreur dans l'enregistrement
    if (isset($_POST)){
        //Pas besoin de vérifier que le formulaire est plein -> déjà gérer par l'html
        //Vérification mdp
        if ($_POST['mdp'] == $_POST['confirmMdp']) {
            //Vérification email unique
            $emails = getListe($bdd,'membres',Array('email' => $_POST['email']),Array(),'email');
            if (!empty($emails)) {
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
        insertListe($bdd,'membres',$_POST);
        unset($_SESSION['savePostRegister']);
        $listeNewMembre = getListe($bdd,'membres',Array("email" => $_POST['email']),Array(),'id');
        $listeNewMembre = $listeNewMembre[0];
        $_SESSION['idClient'] = $listeNewMembre->id;
        header('Location: ../MonCompte.php');
    } else {
        header('Location: ../LoginRegister.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../LoginRegister.php');
}

