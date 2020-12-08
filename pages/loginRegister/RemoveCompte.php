<?php
session_start();
require '../Fonctions.php';
$id = $_SESSION["id"];
$bdd = getDataBase();
if (isset ($bdd)) {
    $password = htmlspecialchars($_POST['mdp']);
    $liste = getListe($bdd,'etudiant',Array("id" => $_SESSION['id']),Array(),'mdp');
    if (password_verify($password, $liste[0]->mdp)) {
        $query = "DELETE FROM etudiant WHERE id=" . $id;
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

