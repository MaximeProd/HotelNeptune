<?php
require 'paterns/Head.php';

if (isset($bdd)){
    if ($idClient !=0) {
        $titrePage = "Vos réservations : ";
        $search = Array();
        //On précomplèe une liste pour avoir le tableau associatif avec toute les clées
        if (isset($_POST)){
            $listeElement = Array('chambre_id','jour','previewNum');
            foreach ($listeElement as $item) {
                if (isset($_POST[$item])){
                    $search += [$item => $_POST[$item]];
                }   else {
                    $search += [$item => ""];
                }
            }
            if (!empty($_POST['selectclient'])) {
                $idClient = $_POST['selectclient'];
                $fullName = getListe($bdd, 'membres',Array('id'=>$idClient),Array(),'nom,prenom');
                $fullName = $fullName[0];
                $titrePage = "Réservation du client n°".$idClient."\n alias (".$fullName->nom. " ".$fullName->prenom. ")";
            }
        }






        //Augmenter la fonction getliste en mettant une liste dans le search

        $chambres = getListe($bdd,'planning, chambres',Array('client_id'=>$idClient),Array('jour'=>$search['jour'],'chambre_id'=>$search['chambre_id']),'*',"numero = chambre_id");
        if ($search["previewNum"] != ""){
            $preview = getListe($bdd,"chambres,tarifs",Array('numero'=>$search["previewNum"]),Array(),'*',"tarif_id=id");
            $preview = $preview[0];
            $pluriel ="";
            if($preview->capacite > 1) {
                $pluriel = "s";
            }

            echo '
         <link rel="stylesheet" href="../css/pageReservation.css">
           <div class="chambre">
          <img src="images/chambre'.$preview->numero.'_1.png">
           <h2>' . $preview->nomChambre . '</h2>
          <div class="division">
           
            <p>Prix : ' . $preview->prix . ' €</p>
            <p>Capacité : ' . $preview->capacite . ' place'.$pluriel.'</p>
            <p>Nombre douche : ' .$preview->douche .'</p>
            <p>Nombre étage : ' .$preview->etage .'</p>
          
          </div>
        </div>
        ';
    }






    echo  '   
           <link rel="stylesheet" href="../css/MesReservations.css">
           <table>
              <caption>'.$titrePage.'</caption>
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
                  <input type="hidden" name="selectclient" value="'.$idClient.'">
                  <th><input type="submit" class="rechercher" value="Rechercher"></th>
                  </form> 
                </tr>
               </thead>
              ';
        if(!empty($chambres)) {
            foreach ($chambres as $chambre) {
                echo
                    '<tbody>
                    <tr>
                    <td>'.$chambre->nomChambre.'</td>
                    <td>'.$chambre->jour.'</td>
                   <td><form class="" action="MesReservations.php" method="post"><input type="hidden" name="previewNum" value="'.$chambre->numero.'"><input type="submit" class="voir" value="Voir"></form></td>
                   <td><input type="hidden" name="selectclient" value="'.$idClient.'"></td>
                        </tr>
                    </tbody>';
            }
        }else{
        echo'<tbody><tr><td class="nul">Aucun résultat</td></tr></tbody>';
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