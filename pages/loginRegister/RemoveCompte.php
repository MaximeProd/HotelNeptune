<?php

require '../Fonctions.php';
$bdd = getDataBase();
$query = "DELETE FROM membres WHERE id=". $_POST["id"];
$statement = $bdd->prepare($query);
$statement->execute();
$statement->closeCursor();
header('Location: ../GérerMembres.php');