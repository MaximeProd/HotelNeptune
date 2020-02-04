<?php
//IMPORTANT !!! La fonction appelé à chaque début "Head.php" comme ci dessous crée déjà une session
// ainsi que l'importation de la bdd et une variable contenant l'id et le niveau d'administration du client actuellement connecté
//C'est variable se nomme dans le même ordre $bdd / $ .
require 'paterns/Head.php';
if (isset($bdd)) {
    $chambres = getListe($bdd,"chambres");
    if ($chambres) {
        foreach ($chambres as $chambre) {
            // Afficher
        echo '
         <link rel="stylesheet" href="../css/celluleChambre.css">
           <div class="chambre">
          <img src="images/chambre'.$chambre->numero.'_1.png">
          <div class="division">
            <h2>Chambre ' . $chambre->numero . '</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  </p>
            <form action="PageReservation.php" method="POST">
                <input type="hidden" name="numChambre" value="'.$chambre->numero.'">
                <input type="submit" value="Voir les réservations"/>
            </form>
          </div>
        </div>';
        }
    } else {
        echo "<p>Aucun résulat</p>";
    }
}


require 'paterns/Foot.php';
?>


