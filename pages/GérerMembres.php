<?php
require 'paterns/Head.php';

if ($admin){
//On précomplète les clées de la liste assiociative qui sert à autocompléter les champs de la page


$search = generateSearch($_POST, Array('id','nom','prenom','email'));
if (isset($bdd)){
    $membres = getListe($bdd,'membres',Array(),$search,'*');
    echo  ' 
       <link rel="stylesheet" href="../css/GérerMembres.css">
       <div class="cadre">
       <div class="bandeau">
       <table class="tableauMembre">
          <caption>Liste des membres</caption>
           <thead> 
            <tr> 
              <th>id</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Email</th>
              <th>Réservations</th>
            </tr>
           </thead>
           <thead> 
            <tr>
              <form autocomplete="off" class="" action="GérerMembres.php" method="post">
              <th><input type="text" name="id" value="'.$search['id'].'"></th>
              <th><input type="text" name="nom" value="'.$search['nom'].'"></th>
              <th><input type="text" name="prenom" value="'.$search['prenom'].'"></th>
              <th><input type="text" name="Email" value="'.$search['email'].'"></th>
              <th><input type="submit" class="valider" name="" ></th>
              <th></th>
              </form> 
            </tr>
           </thead>
          ';
    if(!empty($membres)) {
        foreach ($membres as $membre) {
            echo
                '<tbody>
                <tr>
                <td>'.$membre->id.'</td>
                <td>'.$membre->nom.'</td>
                <td>'.$membre->prenom.'</td>
                <td>'.$membre->email.'</td>
               <th><form class="" action="MesReservations.php" method="post"><input type="submit" class="bonsoir" value="Voir"><input type="hidden" name="selectclient" value="'.$membre->id.'"></form></th>
                <th><form class="" action="loginRegister/Remove.php" method="post"><input type="submit" class="bonsoir" value="Supprimer"><input type="hidden" name="id" value="'.$membre->id.'"></form></th>
                </tr>
                </tbody>';
        }
    }
        echo '
        </table>
    </div>
    </div>';
}
} else {
    afficherErreur("Vous devez être administrateur pour accéder à cette page!");
}

require 'paterns/Foot.php';
