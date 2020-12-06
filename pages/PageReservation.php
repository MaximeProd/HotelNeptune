
<?php
require 'paterns/Head.php';
//https://www.mon-code.net/article/56/Manipulation-des-dates-et-heures-en-PHP5-avec-la-classe-native-DateTime
if (empty($_GET)){
    $_GET = $_SESSION["memoryPost"];
} else {
    $_SESSION["memoryPost"] = $_GET;
}

if (isset($bdd)){
    if(isset($idClient)){
        $numChambre = getGet('numChambre');
        $chambres = getListe($bdd,"chambres,tarifs",Array("numero"=>$numChambre),Array(),'*',"tarif_id=id");
        if (!empty($chambres)) {

            /***************************************
             *
             * Affiche un calendrier mensuel
             * sous forme d'un tableau
             *
             * $m = mois
             * $y = année
             *
             * https://www.afjv.com/forums/sujet/5-266-1-fonction-php-pour-afficher-un-calendrier-en-html
             ****************************************/

            function calendar ($bdd,$m,$numChambre,$idClient)
            {

                $sem = array(6,0,1,2,3,4,5); // Correspondance des jours de la semaine : lundi = 0, dimanche = 6

                $mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
                $week = array('lu','ma','me','je','ve','sa','di');

                $today2 = new DateTime(null, new DateTimeZone('Europe/Paris'));
                $date = clone $today2;
                //echo " - date :".$date->format('Y-m-d');

                $date->modify('+'.$m.' month');
                //echo " - date :".$date->format('Y-m-d');
                $date->modify('first day of this month');
                $m = $date->format('m');


                $dateMax = clone $today2;
                $dateMax->modify("+1 years");
                //echo "Mois demandé :".$date->format('Y-m-d')." - Année max :".$dateMax->format('Y-m-d');


                $query = "SELECT * FROM planning WHERE (chambre_id = ".$numChambre." OR client_id=".$idClient.") 
                                AND (jour like '".$date->format('Y-m')."%' )";
                $statement = $bdd->prepare($query);
                $statement->execute();
                $listeReserv = Array();
                do {
                    $value = $statement->fetch(PDO::FETCH_OBJ);
                    if($value != null) {
                        $reservDate = $value->jour;
                        $reservDate = substr($reservDate, 0,10);
                        $listeReserv += [$reservDate => $value];
                    }
                } while ($value != null);
                $statement->closeCursor();
                //var_dump($listeReserv);


                echo '<table><tbody>';

        // Le mois
        //--------
                echo '<tr><td colspan="7">'.$date->format('Y').'</td></tr>
                    <tr><td colspan="7">'.$mois[$date->format('n')].'</td></tr>';

        // Les jours de la semaine
        //------------------------
                echo '<tr>';
                for ($i = 0 ; $i < 7 ; $i++)
                {
                    echo '<td>'.$week[$i].'</td>';
                }
                echo '</tr>';

        // Le calendrier
        //--------------
                for ($l = 0 ; $l < 6 ; $l++) // calendrier sur 6 lignes
                {
                    echo '<tr>';
                    for ($i = 0 ; $i < 7 ; $i++) // 7 jours de la semaine
                    {
                        $w = $sem[(int)$date->format('w')]; // Jour de la semaine à traiter
                        $m2 = (int)$date->format('n'); // Tant que le mois reste celui du départ
                        //echo $m2;

                        if (($w == $i) && ($m2 == $m)) // Si le jours de semaine et le mois correspondent
                        {
                            $color = "";
                            $lock ="open";
                            $locked = "";
                            $formatDate = $date->format("Y-m-d");
                            if ($date <= $today2 || $date > $dateMax){
                                $color = "blue";
                                $lock = "lock";
                                $locked = 'disabled="disabled"';
                            } elseif (isset($listeReserv[$formatDate])){
                                $lock = "lock";
                                $locked = 'disabled="disabled"';
                                $contenu = $listeReserv[$formatDate];
                                if ($contenu->client_id == $idClient){
                                    $color = "yellow";
                                } else {
                                    $color = "red";
                                }

                            }

                            //Case d'un jour
                            echo '   
                        <td class="'.$color.'">
                          <input class="checkboxCalendrier" id="'.$formatDate.'" type="checkbox" name="'.$formatDate.'" value="'.$formatDate.'" '.$locked.'>
                          <label class="case '.$lock.'" for="'.$formatDate.'">'.$date->format("d").'</label>
                        </td>
                        '  ;// Affiche le jour du mois

                            $date->modify("+ 1 days");
                            //echo $date->format('Y-m-d');

                        }

                        else
                        {
                            echo '<td><p class="case">&nbsp;</p></td>'; // Case vide
                        }
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';

            }

            $m = 0;
            if (isset($_GET["mois"])){
                $m = $_GET["mois"];
            }


            echo '
        <link rel="stylesheet" href="../css/calendrier.css">
        <div class="calendriers">
        <form class="select" method="GET">
          <input type="hidden" name="numChambre" value="'.$numChambre.'">
          <input type="hidden" name="mois" value="'.($m-1).'">
          <input class="moins" type="submit" name="" value="Moins">
        </form>
        <form class="calendriers" action="loginRegister/ValideReservation.php" method="post">
        <input type="hidden" name="chambre_id" value="'.$numChambre.'">
              ';
            calendar($bdd,$m,$numChambre,$idClient);
            calendar($bdd,$m+1,$numChambre,$idClient);
            calendar($bdd,$m+2,$numChambre,$idClient);
            echo '  
        <input class="valid" type="submit" name="" value="Valider">
        </form>
        <form class="select" method="GET">
          <input type="hidden" name="numChambre" value="'.$numChambre.'">
          <input type="hidden" name="mois" value="'.($m+1).'">
            <input class="plus" type="submit" name="" value="Plus">
        </form>
        </div>';


            $chambres = getListe($bdd,"chambres,tarifs",Array('numero'=>$numChambre),Array(),'*',"tarif_id=id");
            $chambre = $chambres[0];
            $pluriel ="";
            if($chambre->capacite > 1) {
                $pluriel = "s";
            }

            echo '
          
         <link rel="stylesheet" href="../css/pageReservation.css">
           <div class="chambre">
          <img src="images/chambre'.$chambre->numero.'_1.png">
           <h2>' . $chambre->nomChambre . '</h2>
          <div class="division">
           
            <p>Prix : ' . $chambre->prix . ' €</p>
            <p>Capacité : ' . $chambre->capacite . ' place'.$pluriel.'</p>
            <p>Nombre douche : ' .$chambre->douche .'</p>
            <p>Nombre étage : ' .$chambre->etage .'</p>
          
          </div>
        </div>
        </div>
        </div>';
        } else {
            afficherErreur("Chambre introuvable");
        }
    } else {
        afficherErreur(13);
    }
} else {
    afficherErreur(7);
}
require 'paterns/Foot.php';
?>

