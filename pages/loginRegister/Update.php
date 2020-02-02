<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd)){
    if (!empty($_POST['civilite']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
        updateListe($bdd,'membres',$_POST,$_SESSION['idClient']);
    }
} else {
    $_SESSION["erreur"]=7;
}

header('Location: ../MonCompte.php');
