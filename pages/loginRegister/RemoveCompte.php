<?php
session_start();
require '../Fonctions.php';
$idClient = $_SESSION["idClient"];
$bdd = getDataBase();
if (isset ($bdd)) {
    $password = htmlspecialchars($_POST['mdp']);
    $liste = getListe($bdd,'membres',Array("id" => $_SESSION['idClient']),Array(),'mdp');
    if (password_verify($password, $liste[0]->mdp)) {
        $query = "DELETE FROM membres WHERE id=" . $idClient;
        $statement = $bdd->prepare($query);
        $statement->execute();
        $statement->closeCursor();
        session_destroy();
        header('Location: ../index.php');
    } else {
        $_SESSION["erreur"] = "Le mot de passe ne correspond pas";
        header('Location: ../MonCompte.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../index.php');
}

