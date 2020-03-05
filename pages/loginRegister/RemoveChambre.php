<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd)){
    $query = "DELETE FROM chambres WHERE numero=". $_POST["numero"];
    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    $_SESSION["erreur"]="Chambre supprimé avec succés";
} else {
    $_SESSION["erreur"]=7;
}
header('Location: ../index.php');