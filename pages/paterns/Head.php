<?php
session_start();
require 'Fonctions.php';
$idClient = null;
$Compte = 'Se connecter/Inscription';
$lien = "LoginRegister.php";
if (isset($_SESSION['idClient'])){
    $idClient = $_SESSION['idClient'];
    $Compte = 'Mon Compte';
    $lien = "MonCompte.php";
}
var_dump($idClient);

$bdd = getDataBase();
$pageAdmin = null;
$admin = false;
if (isset($bdd)){
    $pageAdmin = '';
    if (!empty($bdd)) {
        if (isset($_SESSION['idClient'])) {
            $liste = getListe($bdd, 'membres', Array('id' => $idClient),Array(), 'admin');
            if ($liste[0]->admin == 1) {
                $pageAdmin = '<li><a href="GérerMembres.php">Gérer les membres</a></li>
                              <li><a href="GérerChambres.php">Gérer les chambres</a></li>';
                $admin = true;
            }
        }
    }
} else {
    $_SESSION["erreur"] = 7;
}

echo '
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hotel Neptune</title>
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Acme|Sniglet&display=swap" rel="stylesheet">
    <!--
    font-family: "Sniglet", cursive; →Titre
    font-family: "Acme", sans-serif; →Texte
  -->
  </head>
  <body>
    <header>
      <div class="haut">
        <img src="images/neptune.png">
        <h1>Hotel Neptune</h1>
      </div>
    </header>

    <main>
      <div class="liste">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="MesReservations.php">Mes réservations</a></li>
        '.$pageAdmin.'
        <li><a href="'.$lien.'">'.$Compte.'</a></li>
      </div>
    ';
afficherErreur();
echo '
<div class="master">

';


?>

