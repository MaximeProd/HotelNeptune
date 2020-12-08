<?php
session_start();
$idEtudiant = null;
$Compte = 'Se connecter/Inscription';
$lien = "Inscriptions.php";
if (isset($_SESSION['id'])){
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
    $pageAdmin = '<li><a href="pages/Etudiants.php">Gérer les étudiants</a></li>';
    }
}



if ($idEtudiant){

}
echo '
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Espana Cultura</title>
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Acme|Sniglet&display=swap" rel="stylesheet">

  </head>
  <body>
    <header>
      <div class="haut">
      
        <h1>EspanaCultura</h1>
      </div>
    </header>
   
     
      <div class="Copyright">
        <p>© Copyright 2020</p>
      </div>
    </footer>
    <main>
      <div class="liste">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="Classe">Nos Classes/a></li>
        '.$pageAdmin.'
        <li><a href="'.$lien.'">'.$Compte.'</a></li>
      </div>
    ';?>
