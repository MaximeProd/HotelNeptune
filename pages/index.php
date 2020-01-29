

<?php
//Une variable $idClient est générée à chaque page.
require 'paterns/Head.php';
//$_SESSION['idClient'] = 42;

$bdd = getDataBase();
if (isset($bdd)) {
    $chambres = getListe($bdd,"chambres");
    if($chambres){
        displayChambre($chambres);
    } else {
        echo "<p>Aucun résultat trouvé</p>";
    }
} else {
    echo "Serveur introuvable";
}


require 'paterns/Foot.php';
?>


