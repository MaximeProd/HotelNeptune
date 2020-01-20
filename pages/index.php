

<?php
//Une variable $idClient est générée à chaque page.
require 'paterns/Head.php';
//$_SESSION['idClient'] = 42;
require 'Fonctions.php';
var_dump($idClient);
$bdd = getDataBase();
$chambres = getListe($bdd,"chambres");
if($chambres){
    displayChambre($chambres);
} else {
    echo "<p>Aucun résultat trouvé</p>";
}

?>


