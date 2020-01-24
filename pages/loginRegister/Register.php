<?php
require '../Fonctions.php';
$username = getPost('username');
$mdp = getPost('mdp');
$bdd = getDataBase();
$personnes = getListe($bdd,'membres');
foreach ($personnes as $personne){
    $id = $personne-> id;
    $email = mb_strtolower($personne-> prenom) .'-'. strtolower($personne-> nom) .'-'. $personne-> id.'@fakemail.fr';
    $query = "update membres set email='{$email}' where id=".$id;
    var_dump($query);
    /*
    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();

    */
}
