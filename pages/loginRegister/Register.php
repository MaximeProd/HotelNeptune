<?php
require '../Fonctions.php';
var_dump($_POST);
$bdd = getDataBase();
$cryptPassword = password_hash('espagne34',PASSWORD_DEFAULT);
updateListe($bdd,'membres',Array('mdp'=>$cryptPassword),161);
