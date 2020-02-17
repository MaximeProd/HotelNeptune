<?php
//IMPORTANT !!! La fonction appelé à chaque début "Head.php" comme ci dessous crée déjà une session
// ainsi que l'importation de la bdd et une variable contenant l'id et le niveau d'administration du client actuellement connecté
//C'est variable se nomme dans le même ordre $bdd / $ .
require 'paterns/Head.php';
unset($_SESSION["memoryPost"]);



if (isset($bdd)) {
    $search = generateSearch($_POST, Array("nomChambre","douche","capacite","exposition","numero","prix")); //
    $chambres = getListe($bdd,"chambres,tarifs",Array(),$search,'*',"tarif_id=id");
    ?>
       <link rel="stylesheet" href="../css/GérerMembres.css">
       <div class="cadre">
       <div class="bandeau">
       <table class="Les chambres :">
          <caption>Liste des membres</caption>
           <thead> 
            <tr>
            <?php
            foreach ($search as $key => $element){
                echo "<th>".ucfirst($key)."</th>";
            }
            ?>

            </tr>
           </thead>
           <thead> 
            <tr>
             <form autocomplete="off" class="" action="index.php" method="post">
                <?php
                foreach ($search as $key => $element){
                    echo "<th><input type='text' name='".$key."' value='".$search[$key]."'></th>";
                }
                ?>
              <th><input type="submit" name="" ></th>
              </form>
            </tr>
           </thead>
<?php
    if (!empty($chambres)) {
        foreach ($chambres as $chambre) {
            // Afficher
            $pluriel ="";
            if($chambre->capacite > 1) {
                $pluriel = "s";
            }
        echo '
         <link rel="stylesheet" href="../css/celluleChambre.css">
           <div class="chambre">
          <img src="images/chambre'.$chambre->numero.'_1.png">
          <div class="division">
            <h2>' . $chambre->nomChambre . '</h2>
            <p>Prix : ' . $chambre->prix . ' €</p>
            <p>Capacité : ' . $chambre->capacite . ' place'.$pluriel.'</p>
            <p></p>
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


