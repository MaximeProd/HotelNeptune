<?php
session_start();
$_SESSION["memoryPost"] += $_GET;
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd) && isset($_SESSION["idClient"]) && isset($_POST["chambre_id"])) {
    unset($_SESSION["erreur"]);
    $idChambre = $_POST["chambre_id"];
    unset($_POST["chambre_id"]); //unset pour utiliser le foreach après
    if (!empty($_POST)) {
        $dateTest = new DateTime(key($_POST)); //Date test que l'on va comparé avec les dates de réservation
        $hier = $dateTest->modify("- 1 days");

        if (count($_POST) > 0 && count($_POST) <= 7){
            foreach ($_POST as $aujour) {
                $listeReserv = getListe($bdd, "planning", Array("chambre_id" => $idChambre, "jour" => $aujour));

                $dateTest->modify("+ 1 days");

                if (!empty($listeReserv)) {
                    $_SESSION["erreur"] = 'Chambre déjà réservée';
                } else if ($aujour != $dateTest->format("Y-m-d")) { // On vérifie si le jour correspond au précédent
                    $_SESSION["erreur"] = 'Veuillez saisir des jours consécutifs';
                }
            }
        } else {
            $_SESSION["erreur"] = 'Vous ne pouvez pas réserver plus d\'une semaine une chambre';
        }
        if (!isset($_SESSION["erreur"])) {
            $_SESSION["erreur"] = 'Chambre réservé avec succés';
            foreach ($_POST as $jour) {
                insertListe($bdd, 'planning', Array("jour"=>$jour,"chambre_id"=>$idChambre,"client_id"=>$_SESSION["idClient"]));
                header('Location: ../MesReservations.php');
            }
        } else {
            header('Location: ../PageReservation.php');
        }
    } else {
        $_SESSION["erreur"] = 'Aucun jour sélectionné';
        header('Location: ../PageReservation.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../PageReservation.php');
}



