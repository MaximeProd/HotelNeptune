<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
//var_dump(empty($_POST["nom"]));


if (!empty($_POST['civilite']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
    updateListe($bdd,'membres',$_POST,$_SESSION['idClient']);
    //var_dump($_POST);
    //var_dump($_SESSION['idClient']);
}

header('Location: ../MonCompte.php');
