<?php
session_start();
require '../Fonctions.php';

$listPost = $_POST;
$_SESSION["erreur"] = 0;
$_SESSION['savePostLogin'] = $_POST;
//var_dump($listPost);
if (isset($listPost['mdp']) AND isset($listPost['email'])){
    $bdd = getDatabase();
    $password = htmlspecialchars($_POST['mdp']);
    $liste = getListe($bdd,'membres',Array("email" => $listPost['email']),'mdp,id');
    //var_dump($liste);
    //var_dump($liste[0]->id);
    if(!empty($liste)){
        if(count($liste)==1 && password_verify($password,$liste[0]->mdp)){
            $idClient = $liste[0]->id;
            $_SESSION['idClient'] = $idClient;
            unset($_SESSION['savePostLogin']);
            header('Location: ../index.php');
        } elseif (count($liste) > 1){
            $_SESSION['idClient'] = $idClient;
            //Erreur : Il existe plusieur client avec la même adresse mail!! Grosse erreur d'identification!
            $_SESSION["erreur"] = 1;
        } else {
            //Erreur fréquente : le mot de passe ou l'email ne correspond pas
            $_SESSION["erreur"] = 2;
        }
    } else {
        //Erreur aussi fréquente : L'email n'est pas reconnu
        $_SESSION["erreur"] = 3;
    }
    header('Location: ../LoginRegister.php');
}





