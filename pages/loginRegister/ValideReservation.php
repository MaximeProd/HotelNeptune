<?php
session_start();
if (!empty($_POST)){
    asort($_POST);
    $jourConsectuif = true;
    $aujour = key($_POST)-86400;
    if (count($_POST) >0) {
        foreach ($_POST as $demain => $etat) {

            if ($demain == $aujour + 86400){
                $aujour = $demain;
            } else {
                $jourConsectuif = false;
            }
        }
    }
    if ($jourConsectuif) {
        foreach ($_POST as $jour => $etat) {
            $resrv = date('Y-m-d', $jour);
            header('Location: ../calendrier.php');
        }
    } else {
        $_SESSION["erreur"] = 8;
        header('Location: ../calendrier.php');
    }
} else {
        $_SESSION["erreur"] = 9;
    header('Location: ../calendrier.php');
}



