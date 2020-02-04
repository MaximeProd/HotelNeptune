
<?php
require 'paterns/Head.php';


echo 'Bonsoir!';

$numChambre = getPost('numChambre');

var_dump($idClient);
var_dump($numChambre);
echo $idClient.'<br>';
echo $numChambre;

$chambres = getListe($bdd,"chambres",Array("numero"=>$numChambre));
$chambre = $chambres[0];
if ($chambres) {
    echo '

<html>
<meta charset="utf-8">
<title>Hotel Neptune</title>
<link rel="stylesheet" href="../css/MesReservations.css">
<link href="https://fonts.googleapis.com/css?family=Acme|Sniglet&display=swap" rel="stylesheet">
<body>


<div class="fake">
    <div class="chambre">
        <img src="../../HotelNeptune5Ok/HotelNeptune/pages/images/neptune.png">
        <div class="division">

            <h2>Chambre num</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non </p>

            <div class="bouttonReservation">
                <form action="PlusInfo.php" method="POST">
                    <input type="hidden" name="numChambre" value="' . $chambre->numero . '">
                    <input type="submit" value="Plus d\'info"/>
                </form>
                <form action="Annuler.php" method="POST">
                    <input type="hidden" name="numChambre" value="' . $chambre->numero . '">
                    <input type="submit" value="Annuler"/>
                </form>
            </div>
        </div>
    </div>
    
    <div class="chambre">
        <h3>Date de Début : 01/10/2000</h3>
        <h3>Date de Fin : 06/12/2001</h3>
    </div>
</div>
';
}
require 'paterns/Foot.php';
?>

