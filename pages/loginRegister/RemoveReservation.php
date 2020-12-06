<?php

session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd)){
    if (!empty($_POST['civilite']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
        updateListe($bdd,'planning',$_POST,"id=".$_SESSION['idClient']);
    }
    $_SESSION["erreur"] = "Compte modifié avec succés";
} else {
    $_SESSION["erreur"]=7;
}

header('Location: ../MonCompte.php');