
<?php
require 'paterns/Head.php';

if (empty($_POST)){
    $_POST = $_SESSION["memoryPost"];
} else {
    $_SESSION["memoryPost"] = $_POST;
}

if (isset($bdd)){
    if(isset($idClient)){
        $numChambre = getPost('numChambre');
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

            function calendar ($bdd,$m, $y,$numChambre)
            {
                $sem = array(6,0,1,2,3,4,5); // Correspondance des jours de la semaine : lundi = 0, dimanche = 6

                $mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
                $week = array('lu','ma','me','je','ve','sa','di');

                $t = mktime(12, 0, 0, $m, 1, $y); // Timestamp du premier jour du mois
                $today = mktime(12, 0, 0, date('m'), date('d'), date('Y'))+86400;
                echo '<table><tbody>';

        // Le mois
        //--------
                echo '<tr><td colspan="7">'.$y.'</td></tr>
                    <tr><td colspan="7">'.$mois[$m].'</td></tr>';

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
                        $w = $sem[(int)date('w',$t)]; // Jour de la semaine à traiter
                        $m2 = (int)date('n',$t); // Tant que le mois reste celui du départ

                        //$demain = date('Y-m-d', strtotime(date($date).' +1 days'));
                        if (($w == $i) && ($m2 == $m)) // Si le jours de semaine et le mois correspondent
                        {
                            $date= $y.'-'.date('m',$t).'-'.date('d',$t);
                            $listeReserv = getListe($bdd,"planning",Array("chambre_id"=>$numChambre,"jour"=>$date));
                            $id = 'toggle'.$t.'';
                            $color = "";
                            $lock ="open";
                            $locked = "";
                            if (!empty($listeReserv)){
                                $color = "red";
                                $lock = "lock";
                                $locked = 'disabled="disabled"';
                            }
                            if ($today > $t){
                                $color = "blue";
                                $lock = "lock";
                                $locked = 'disabled="disabled"';
                            }

                            $var = date('j',$t);
                            echo '   
                        <td class="'.$color.'">
                          <input class="checkboxCalendrier" id="toggle'.$t.'" type="checkbox" name="'.$t.'" '.$locked.'>
                          <label class="case '.$lock.'" for="'.$id.'">'.$var.'</label>
                        </td>
                        '  ;// Affiche le jour du mois

                            $t += 86400; // Passe au jour suivant
                        }
                        else
                        {
                            echo '<td>&nbsp;</td>'; // Case vide
                        }
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';

            }

            $m = date('Y-n');
            if (isset($_POST["mois"])){
                $m = $_POST["mois"];
            }
            $mParse = date_parse($m);

            $mMoins = date('Y-n',(strtotime($m.'- 1 months')));

            $mPlus = date('Y-n',(strtotime($m.'+ 1 months')));
            $mPlusParse = date_parse($mPlus);

            $mPlusPlus = date('Y-n',(strtotime($m.'+ 2 months')));
            $mPlusPlusParse = date_parse($mPlusPlus);

            echo '<link rel="stylesheet" href="../css/calendrier.css"><td>Bonsoir</td>';
            echo '
        <div class="calendriers">
        <form class="select" method="post">
          <input type="hidden" name="numChambre" value="'.$numChambre.'">
          <input type="hidden" name="mois" value="'.$mMoins.'">
          <input type="submit" name="" value="Moins">
        </form>
        <form class="calendriers" action="loginRegister/ValideReservation.php" method="post">
        <input type="hidden" name="chambre_id" value="'.$numChambre.'">
              ';
            calendar($bdd,$mParse["month"],$mParse["year"],$numChambre);
            calendar($bdd,$mPlusParse["month"],$mPlusParse["year"],$numChambre);
            calendar($bdd,$mPlusPlusParse["month"],$mPlusPlusParse["year"],$numChambre);
            echo '  
        <input type="submit" name="" value="Valider">
        </form>
        <form class="select" method="post">
          <input type="hidden" name="numChambre" value="'.$numChambre.'">
          <input type="hidden" name="mois" value="'.$mPlus.'">
          <input type="submit" name="" value="Plus">
        </form>';

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

