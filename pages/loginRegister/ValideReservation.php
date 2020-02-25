<?php
session_start();
$_SESSION["memoryPost"] += $_GET;
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd) && isset($_SESSION["idClient"]) && isset($_POST["chambre_id"])) {
    unset($_SESSION["erreur"]);
    $idChambre = $_POST["chambre_id"];
    unset($_POST["chambre_id"]);
    if (!empty($_POST)) {
        asort($_POST);
        $hier = key($_POST) - 86400;
        if (count($_POST) > 0 && count($_POST) <= 7){
            foreach ($_POST as $aujour => $etat) {
                $date = date('Y-m-d', $aujour);
                $listeReserv = getListe($bdd, "planning", Array("chambre_id" => $idChambre, "jour" => $date));
                if ($aujour == $hier + 86400) {
                    $hier = $aujour;
                } else {
                    $_SESSION["erreur"] = 8;
                }
                if (!empty($listeReserv)) {
                    $_SESSION["erreur"] = 10;
                }
            }
        } else {
            $_SESSION["erreur"] = 12;
        }
        if (!isset($_SESSION["erreur"])) {
            $_SESSION["erreur"] = 11;
            foreach ($_POST as $jour => $etat) {
                $resrv = date('Y-m-d', $jour);
                //var_dump(Array("jour"=>$resrv,"chambre_id"=>$idChambre,"client_id"=>$_SESSION["idClient"]));
                insertListe($bdd, 'planning', Array("jour"=>$resrv,"chambre_id"=>$idChambre,"client_id"=>$_SESSION["idClient"]));
                header('Location: ../MesReservations.php');
            }
        } else {
            header('Location: ../PageReservation.php');
        }
    } else {
        $_SESSION["erreur"] = 9;
        header('Location: ../PageReservation.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../PageReservation.php');
}



