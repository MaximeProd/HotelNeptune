<?php
session_start();
require '../Fonctions.php';

$bdd = getDataBase();
$insert = Array();
$_SESSION["erreur"] = 0;
$_SESSION['savePostRegister'] = $_POST;
if (isset($_POST)){
    /*
    //Vérification de la complétion du formulaire :
    $listeElement = Array('nom','prenom','email','mdp','confirmMdp');
    foreach ($listeElement as $item) {
        if (!isset($_POST[$item])){
            $_SESSION["erreur"] = 6;
        }
    }
    */
    //Vérification mdp
    if ($_POST['mdp'] == $_POST['confirmMdp']) {
        //Vérification email unique
        $emails = getListe($bdd,'membres',Array('email' => $_POST['email']),'email');
        if (!empty($emails)) {
            $_SESSION["erreur"] = 5;
        }
    } else {
        $_SESSION["erreur"] = 2;
    }
}
if ($_SESSION["erreur"] == 0) {
    //Cryptage mdp :
    $_POST['mdp'] = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
    //Génération membre :
    unset($_POST['confirmMdp']);
    insertListe($bdd,'membres',$_POST);
    unset($_SESSION['savePostRegister']);
    header('Location: ../index.php');
} else {
    header('Location: ../LoginRegister.php');
}

