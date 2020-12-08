<?php
require 'paterns/Head.php';

if ($admin){
//On précomplète les clées de la liste assiociative qui sert à autocompléter les champs de la page


$search = generateSearch($_POST, Array('id','nom','prenom'));
if (isset($bdd)) {
    $professeur = getListe($bdd, 'professeur', array(), $search, '*');
    echo ' 
       <link rel="stylesheet" href="../css/GérerProfesseur.css">
       <div class="cadre">
       <div class="bandeau">
       <table class="tableauProfesseur">
          <caption>Liste des membres</caption>
           <thead> 
            <tr> 
              <th>id</th>
              <th>Nom</th>
              <th>Prenom</th>
              
            </tr>
           </thead>
           <thead> 
            <tr>
              <form autocomplete="off" class="" action="Professeurs.php" method="post">
              <th><input type="text" name="id" value="' . $search['id'] . '"></th>
              <th><input type="text" name="nom" value="' . $search['nom'] . '"></th>
              <th><input type="text" name="prenom" value="' . $search['prenom'] . '"></th>
              
             
              <th></th>
              </form> 
            </tr>
           </thead>
          ';
    if (!empty($professeur)) {
        foreach ($professeurs as $professeur) {
            echo
                '<tbody>
                <tr>
                <td>' . $professeur->id . '</td>
                <td>' . $professeur->nom . '</td>
                <td>' . $professeur->prenom . '</td>
                
               <th><form class="" action="Classe.php" method="post"><input type="submit" class="bonsoir" value="Voir"><input type="hidden" name="selectclient" value="' . $professeur->id . '"></form></th>
                <th><form class="" action="loginRegister/RemoveProfesseurs.php" method="post"><input type="submit" class="bonsoir" value="Supprimer"><input type="hidden" name="id" value="' . $professeur->id . '"></form></th>
                </tr>
                </tbody>';
        }
    }
}
} else {
    afficherErreur("Vous devez être administrateur pour accéder à cette page!");
}

require 'paterns/Foot.php';
