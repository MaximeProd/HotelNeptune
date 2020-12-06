<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd)){
    if (isset($_POST)){
        updateListe($bdd,'membres',$_POST,"id".$_SESSION['idClient']);
        $_SESSION["erreur"] = "Compte modifié avec succés";
    }
} else {
    $_SESSION["erreur"]=7;
}

header('Location: ../MonCompte.php');
