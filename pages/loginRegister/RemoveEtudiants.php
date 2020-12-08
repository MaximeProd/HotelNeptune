<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd)){
    $query =  "DELETE FROM etudiant WHERE id=" . $id;
    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();
} else {
    $_SESSION["erreur"]=7;
}
header('Location: ../Etudiants.php');