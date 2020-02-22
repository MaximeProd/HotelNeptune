<?php
session_start();
require '../Fonctions.php';
// Copie dans le repertoire du script avec un nom
// incluant l'heure a la seconde pres
var_dump($_POST);
unset($_SESSION["erreur"]);

if(isset($_POST)){
    $bdd = getDataBase();
    $getid = getListe($bdd,"chambres",Array(),Array(),"numero");
    $numero = end($getid)->numero + 1;
    $repertoireDestination = "../images/";
    $nomDestination        = "chambre".$numero."_1".".png";
    var_dump($numero);
    if (is_uploaded_file($_FILES["monfichier"]["tmp_name"])) {
        if (!rename($_FILES["monfichier"]["tmp_name"],
            $repertoireDestination.$nomDestination)) {
            $_SESSION["erreur"] = "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
        }
    } else {
        $_SESSION["erreur"] = "Le fichier n'a pas été uploadé (trop gros ?)";
    }
    if ($_POST["tarif_id"] == "Sélectionner un prix"){
        $_SESSION["erreur"] = "Veuillez sélectionner un prix !";
    }
    if (!isset($_SESSION["erreur"])){
        $bdd = getDataBase();
        unset($_POST["image"]);
        insertListe($bdd,"chambres",$_POST);
        $_SESSION["erreur"] = "Chambre ajouté avec succée !";
        header('Location: ../index.php');
    } else {
        header('Location: ../GérerChambres.php');
    }
} else {
    $_SESSION["erreur"] = "Accès réservé";
    header('Location: ../GérerChambres.php');
}


?>