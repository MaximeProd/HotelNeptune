<?php
session_start();
require '../Fonctions.php';

$bdd = getDatabase();
$listPost = $_POST;
$_SESSION['savePostLogin'] = $_POST;

if(isset($bdd)){
    $_SESSION["erreur"] = null;
    if (isset($listPost['u_password'])){
        $password = htmlspecialchars($_POST['u_password']);
        $liste = getListe($bdd,'user',Array(),'u_password,u_id');
        if(!empty($liste)){
            if(count($liste)==1 && password_verify($password,$liste[0]->mdp)){
                $id = $liste[0]->id;
                $_SESSION['idClient'] = $id;
                unset($_SESSION['savePostLogin']);
            } elseif (count($liste) > 1){
                $_SESSION['idClient'] = $id;

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




