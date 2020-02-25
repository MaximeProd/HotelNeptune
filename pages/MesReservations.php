<?php
require 'paterns/Head.php';

if (isset($bdd)){
    if ($idClient !=0) {
        $search = Array();
        //On précomplèe une liste pour avoir le tableau associatif avec toute les clées
        if (isset($_POST)){
            $listeElement = Array('chambre_id','jour');
            foreach ($listeElement as $item) {
                if (isset($_POST[$item])){
                    $search += [$item => $_POST[$item]];
                }   else {
                    $search += [$item => ""];
                }

            }
            if (!empty($search['selectclient'])) {
                $idClient = $_POST['selectclient'];
                }
        }

        //Augmenter la fonction getliste en mettant une liste dans le search
        $chambres = getListe($bdd,'planning',Array('client_id'=>$idClient),Array('jour'=>$search['jour'],'chambre_id'=>$search['chambre_id']),'*');
        echo  '   
           <link rel="stylesheet" href="../css/MesReservations.css">
           <table>
              <caption>Liste des membres</caption>
               <thead> 
                <tr> 
                  <th>Nom</th>
                  <th>Date</th>
                </tr>
               </thead>
               <thead> 
                <tr>
                  <form autocomplete="off" class="" action="MesReservations.php" method="post">
                  <th><input type="text" name="chambre_id" value="'.$search['chambre_id'].'"></th>
                  <th><input type="text" name="jour" value="'.$search['jour'].'"></th>
                  <th><input type="hidden" name="selectclient" value="'.$idClient.'"></th>
           
                  <th><input type="submit" name="" ></th>
                  <th></th>
                  </form> 
                </tr>
               </thead>
              ';
        if(!empty($chambres)) {
            foreach ($chambres as $chambre) {
                echo
                    '<tbody>
                    <tr>
                    <td>'.$chambre->chambre_id.'</td>
                    <td>'.$chambre->jour.'</td>
                   <th><form class="" action="MesReservations.php" method="post"><input type="submit" value="Voir">
                   <th><input type="hidden" name="selectclient" value="'.$idClient.'"></th>
                    <p>Prix : \' . $chambre->prix . \' €</p>
            <p>Capacité : \' . $chambre->capacite . \' place\'.$pluriel.\'</p>
            <p>Nombre douche : \' .$chambre->douche .\'</p>
            <p>Nombre étage : \' .$chambre->etage .\'</p>\';
                        </tr>
                    </tbody>';
            }
        }
        echo '
            </table>
        </table>';

    } else {
    afficherErreur('Vous devez être connecté pour voir vos réservations : <a href="LoginRegister.php"> > Page connexion < </a>');
    }
}

require 'paterns/Foot.php';
?>