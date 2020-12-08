<?php
require 'paterns/Head.php';

if ($admin){
//On précomplète les clées de la liste assiociative qui sert à autocompléter les champs de la page


    $search = generateSearch($_POST, Array('id','nom',));
    if (isset($bdd)) {
        $matiere = getListe($bdd, 'matière', array(), $search, '*');
        echo ' 
    
       <div class="cadre">
       <div class="bandeau">
       <table class="tableauProfesseur">
          <caption>Liste des matières</caption>
           <thead> 
            <tr> 
              <th>id</th>
              <th>Nom</th>
              
              
            </tr>
           </thead>
           <thead> 
            <tr>
              <form autocomplete="off" class="" action="Matières.php.php" method="post">
              <th><input type="text" name="id" value="' . $search['id'] . '"></th>
              <th><input type="text" name="nom" value="' . $search['nom'] . '"></th>
            
             
              <th></th>
              </form> 
            </tr>
           </thead>
          ';
        if (!empty($matiere)) {
            foreach ($matieres as $matiere) {
                echo
                    '<tbody>
                <tr>
                <td>' . $matiere->id . '</td>
                <td>' . $matiere->nom . '</td>
              
                
               <th><form class="" action="Classe.php" method="post"><input type="submit" class="bonsoir" value="Voir"><input type="hidden" name="selectclient" value="' . $matiere->id . '"></form></th>
                <th><form class="" action="loginRegister/RemoveMatiere.php" method="post"><input type="submit" class="bonsoir" value="Supprimer"><input type="hidden" name="id" value="' . $matiere->id . '"></form></th>
                </tr>
                </tbody>';
            }
        }
    }
} else {
    afficherErreur("Vous devez être administrateur pour accéder à cette page!");
}

require 'paterns/Foot.php';

