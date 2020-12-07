<?php
session_start();
require '../Fonctions.php';

$bdd = getDatabase();
$listPost = $_POST;
$_SESSION['savePostLogin'] = $_POST;

if(isset($bdd)){
    $_SESSION["erreur"] = null;
    if (isset($listPost['u_password']) AND isset($listPost['u_email'])){
        $password = htmlspecialchars($_POST['u_password']);
        $liste = getListe($bdd,'user',Array("u_email" => $listPost['u_email']),Array(),'u_password,u_id');
        if(!empty($liste)){
            if(count($liste)==1 && password_verify($password,$liste[0]->mdp)){
                $idClient = $liste[0]->id;
                $_SESSION['idClient'] = $idClient;
                unset($_SESSION['savePostLogin']);
            } elseif (count($liste) > 1){
                $_SESSION['idClient'] = $idClient;

                $_SESSION["erreur"] = 1;
            } else {

                $_SESSION["erreur"] = 2;
            }
        } else {

            $_SESSION["erreur"] = 3;
        }
    }
} else {
    $_SESSION["erreur"] = 7;
}
if (isset($_SESSION['idClient'])){
    header('Location: ../MonCompte.php');
} else {
    header('Location: ../Inscription.php');
}




