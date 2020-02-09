
<?php
require 'paterns/Head.php';

$numChambre = getPost('numChambre');

$chambres = getListe($bdd,"chambres,tarifs",Array("numero"=>$numChambre),Array(),'*',"tarif_id=id");
if (!empty($chambres)) {

    $search = generateSearch($_POST, Array("start","end"));
    $search["start"]= '2018-03-22';
    $check = getListe($bdd,"planning",Array("jour"=>$search["start"]));
    var_dump($check);
    $chambre = $chambres[0];
    $ext = "2020-02-29";
    $demain = date('Y-m-d', strtotime(date('Y-m-d').' +1 days'));
    $demainTmp = strtotime($demain);


    echo '

      <div class="fake">
        <div class="case reservation">
          <div class="detail">
          
          </div>
          <form class="" action="PageReservation.php" method="post">
            <label for="start">Date début séjour :</label>
            <input type="date" name="start" value="" min="2020-02-02" max="2021-02-02" >
            
            <label for="end">Date fin séjour :</label>
            <input type="date" name="end" value="" min="2020-02-02" max="2021-02-02" >
            

            <input type="hidden" name="numChambre" value="' . $chambre->numero . '">
            <input type="submit" value="Réserver"/>
            </form>
            <p>Annuler</p>
        </div>
      </div>
';
}
require 'paterns/Foot.php';
?>

