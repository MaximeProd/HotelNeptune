<?php
session_start();
require '../Fonctions.php';

$listPost = $_POST;
//var_dump($listPost);
if (isset($listPost['mdp']) AND isset($listPost['email'])){
    $bdd = getDatabase();
    $liste = getListe($bdd,'membres',$listPost);
    //var_dump($liste[0]->id);
    if(!empty($liste)){
        if(count($liste)==1){
            $idClient = $liste[0]->id;
            $_SESSION['idClient'] = $idClient;
            header('Location: ../index.php');
        } else {
            header('Location: ../LoginRegister.php?FatalError=True');
        }
    } else {
        header('Location: ../LoginRegister.php?error=True');
    }
}





