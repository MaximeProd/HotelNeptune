<?php
session_start();
$idEtudiant = null;
$Compte = 'Se connecter/Inscription';
$lien = "LoginRegister.php";
if (isset($_SESSION['idClient'])){
    $idEtudiant = $_SESSION['idEtudiant'];
    $Compte = 'Mon Compte';
    $lien = "MonCompte.php";
}

$_SESSION['admin'] = False;
$admin = null;
$pageAdmin = '';
if (isset($_SESSION['admin'])){
    $admin = $_SESSION['admin'];
    if ($admin == 1){
    $pageAdmin = '<li><a href="GérerMembres.php">Gérer les membres</a></li>';
    }
}



if ($idEtudiant){

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
    <footer>
      <div class="footer">
        <a href="#">Qui somme-nous? </a>
        <a href="#">Tarif </a>
        <a href="#">Mention légale </a>
        <a href="#">Asssistance </a>
        <a href="#">Fonctionnement Du Site </a>
        <a href="#">Aide </a>
      </div>
      <div class="Copyright">
        <p>© Copyright 2020</p>
      </div>
    </footer>
    <main>
      <div class="liste">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="MesReservations.php">Mes réservations</a></li>
        '.$pageAdmin.'
        <li><a href="'.$lien.'">'.$Compte.'</a></li>
      </div>
    ';?>
