<?php
session_start();
require '../Fonctions.php';
$bdd = getDataBase();
if (isset($bdd) && isset($_SESSION["idClient"]) && isset($_POST["chambre_id"])) {
    unset($_SESSION["erreur"]);
    $idChambre = $_POST["chambre_id"];
    unset($_POST["chambre_id"]);
    if (!empty($_POST)) {
        asort($_POST);
        $hier = key($_POST) - 86400;
        if (count($_POST) > 0) {
            foreach ($_POST as $aujour => $etat) {
                $date = date('Y-m-d', $aujour);
                $listeReserv = getListe($bdd, "planning", Array("chambre_id" => 1, "jour" => $date));
                if ($aujour == $hier + 86400) {
                    $hier = $aujour;
                } else {
                    $_SESSION["erreur"] = 8;
                }
                if (!empty($listeReserv)) {
                    $_SESSION["erreur"] = 10;
                }
            }
        }
        if (!isset($_SESSION["erreur"])) {
            $_SESSION["erreur"] = 11;
            foreach ($_POST as $jour => $etat) {
                $resrv = date('Y-m-d', $jour);
                var_dump(Array("jour"=>$resrv,"chambre_id"=>$idChambre,"client_id"=>$_SESSION["idClient"]));
                insertListe($bdd, 'planning', Array("jour"=>$resrv,"chambre_id"=>$idChambre,"client_id"=>$_SESSION["idClient"]));
                header('Location: ../MesReservations.php');
            }
        } else {
            header('Location: ../calendrier.php');
        }
    } else {
        $_SESSION["erreur"] = 9;
        header('Location: ../calendrier.php');
    }
} else {
    $_SESSION["erreur"] = 7;
    header('Location: ../calendrier.php');
}



