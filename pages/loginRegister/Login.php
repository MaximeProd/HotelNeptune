<?php
session_start();
require '../Fonctions.php';

$username = getPost('username');
$mdp = getPost('mdp');
$argument = Array('prenom'=>'Maxime','nom'=>'BOURRIER');
if (isset($username,$mdp)){
    $bdd = getDatabase();
    $liste = getListe($bdd,'membres',$argument,False);
    if(!empty($liste)){
        //header('Location: ../index.php');
    } else {
        //header('Location: ../LoginRegister.php?error=True');
    }

} else {
    // header('Location: ../LoginRegister.php?error=True');
}

$idClient = $username;
$_SESSION['idClient'] = $idClient;



