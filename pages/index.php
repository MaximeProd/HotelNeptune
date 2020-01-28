

<?php
//Une variable $idClient est générée à chaque page.
require 'paterns/Head.php';
//$_SESSION['idClient'] = 42;
require 'Fonctions.php';
var_dump($idClient);
$bdd = getDataBase();
if (isset($bdd)) {
    $chambres = getListe($bdd,"chambres");
    if($chambres){
        displayChambre($chambres , $bdd);
    } else {
        echo "<p>Aucun résultat trouvé</p>";
    }
} else {
    echo "Serveur introuvable";
}

?>


