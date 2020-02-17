<?php
session_start();
// Copie dans le repertoire du script avec un nom
// incluant l'heure a la seconde pres
$numChambre = 501;
$repertoireDestination = "../images/";
$nomDestination        = "chambre".$numChambre."_1".".png";

if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) {
    if (rename($_FILES["monfichier"]["tmp_name"],
        $repertoireDestination.$nomDestination)) {
        $_SESSION["erreur"] = "Le fichier temporaire ".$_FILES["monfichier"]["tmp_name"].
            " a été déplacé vers ".$repertoireDestination.$nomDestination;
    } else {
        $_SESSION["erreur"] = "Le déplacement du fichier temporaire a échoué".
            " vérifiez l'existence du répertoire ".$repertoireDestination;
    }
} else {
    $_SESSION["erreur"] = "Le fichier n'a pas été uploadé (trop gros ?)";
}
header('Location: ../GérerChambres.php');
?>