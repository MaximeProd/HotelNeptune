<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd)){
    $query = "DELETE FROM membres WHERE id=". $_POST["id"];
    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();
} else {
    $_SESSION["erreur"]=7;
}
header('Location: ../GérerMembres.php');