<?php
require 'paterns/Head.php';

echo '<link rel="stylesheet" href="../css/calendrier.css"><td>Bonsoir</td>';

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

function calendar ($bdd,$m, $y)
{
    $sem = array(6,0,1,2,3,4,5); // Correspondance des jours de la semaine : lundi = 0, dimanche = 6

    $mois = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
    $week = array('lu','ma','me','je','ve','sa','di');

    $t = mktime(12, 0, 0, $m, 1, $y); // Timestamp du premier jour du mois

    echo '

<table><tbody>';

// Le mois
//--------
    echo '<tr><td colspan="7">'.$mois[$m].'</td></tr>';

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

            $demain = date('Y-m-d', strtotime(date('Y-m-d').' +1 days'));
            if (($w == $i) && ($m2 == $m)) // Si le jours de semaine et le mois correspondent
            {
                $date= $y.'-'.date('m',$t).'-'.date('d',$t);
                $listeReserv = getListe($bdd,"planning",Array("chambre_id"=>1,"jour"=>$date));
                $id = 'id="open"';
                if (!empty($listeReserv)){
                    $id = 'id="lock"';
                    var_dump($id);
                }
                $var = date('j',$t);
                echo '<label for="'.$date.'"><td '.$id.'>'.$var.'</td></label><input type="checkbox" class="test" name="'.$date.'">'; // Affiche le jour du mois
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

calendar($bdd,01,2020)
?>