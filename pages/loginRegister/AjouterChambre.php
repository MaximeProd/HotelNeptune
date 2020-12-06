<?php
session_start();
require '../Fonctions.php';
// Copie dans le repertoire du script avec un nom
// incluant l'heure a la seconde pres
//var_dump($_POST);
unset($_SESSION["erreur"]);
$_SESSION['saveChambre'] = $_POST;
if(isset($_POST)){
    $bdd = getDataBase();
    /*
    $getid = getListe($bdd,"chambres",Array(),Array(),"numero");
    $numero = end($getid)->numero + 1;

    $nomOrigine = $_FILES["monfichier"]["name"];
    $elementsChemin = pathinfo($nomOrigine);
    $extensionFichier = $elementsChemin['extension'];
    $extensionsAutorisees = array("jpeg", "jpg", "gif");
    var_dump($_FILES["monfichier"]["name"]);
    if (!(in_array($extensionFichier, $extensionsAutorisees))) {
        $_SESSION["erreur"] = "Le fichier n'a pas l'extension attendue";
    } else {
        // Copie dans le repertoire du script avec un nom
        // incluant l'heure a la seconde pres
        $repertoireDestination = "../images/";
        $nomDestination = "chambre".$numero."_1".$extensionFichier;

        if (move_uploaded_file($_FILES["monfichier"]["tmp_name"],
            $repertoireDestination.$nomDestination)) {
            $_SESSION["erreur"] = "Le fichier temporaire ".$_FILES["monfichier"]["tmp_name"].
                " a été déplacé vers ".$repertoireDestination.$nomDestination;
        } else {
            $_SESSION["erreur"] = "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
        }
    }
    */

    if ($_POST["tarif_id"] == "Sélectionner un prix"){
        $_SESSION["erreur"] = "Veuillez sélectionner un prix !";
    }
    $bdd = getDataBase();
    if (!isset($_SESSION["erreur"])) {
        if ($_POST["modif"] != ""){
            unset($_POST["image"]);
            $modif = $_POST["modif"];
            unset($_POST["modif"]);
            unset($_POST["monfichier"]);
            updateListe($bdd,'chambres',$_POST,"numero=".$modif);
            $_SESSION["erreur"] = "Chambre modifié avec succès !";
            unset($_SESSION['saveChambre']);
            header('Location: ../index.php');
        } else {
            unset($_POST["image"]);
            unset($_POST["modif"]);
            unset($_POST["monfichier"]);
            insertListe($bdd, "chambres", $_POST);
            $_SESSION["erreur"] = "Chambre ajouté avec succée !";
            unset($_SESSION['saveChambre']);
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../GérerChambres.php');
    }

} else {
    $_SESSION["erreur"] = "Accès réservé";
    //header('Location: ../GérerChambres.php');
}


?>