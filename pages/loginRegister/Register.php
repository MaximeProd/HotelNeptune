<?php
require '../Fonctions.php';
$username = getPost('username');
$mdp = getPost('mdp');
$bdd = getDataBase();
$etudiant = getListe($bdd,'etudiant');
foreach ($username as $etudiant){
    $id = $etudiant-> id;
    $email = mb_strtolower($etudiant-> prenom) .'-'. strtolower($etudiant-> nom) .'-'. $etudiant-> id.'@fakemail.fr';
    $query = "update etudiant set email='{$email}' where id=".$id;
    var_dump($query);
    /*
    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();

    */
}
