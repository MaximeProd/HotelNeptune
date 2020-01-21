
<?php
//Session :
//https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/4239476-session-cookies
//Array :
//https://www.php.net/manual/fr/control-structures.foreach.php
function getDataBase() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=bddneptune;charset=utf8',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function getListe(PDO $bdd,$askListe,Array $args = [],$search = False) {
    var_dump($args);
    //Pour utiliser cette fonction il faut lui envoyer :
    //La bdd
    //Le(s) table au quel on veux accéder
    //Une liste des condtions à récupérer tel que :
    // array(arg1 => value1, arg2 => value 2, etc)
    //Avec un exemple :
    // array( 'idClient' => 15, 'prenom' => 'Maxime')

    $query = "SELECT * FROM {$askListe} WHERE 1 ";

    //Etape 1 : On génère la requête sql avec les arguments demandés :
    foreach ($args as $key => $arg) {
        $query = "{$query} AND {$key} LIKE :p_{$key} ";
    }
    //Affectation des paramètres (Pour rappel les paramètres (p_arg) sont une sécuritée)
    var_dump($query);
    $compteur = 0;
    $statement = $bdd->prepare($query);
    foreach ($args as $key => $arg) {
        $compteur ++;
        $argmodif = $arg . '%';
        $para = ':p_'.$key;
        var_dump($argmodif);
        $statement->bindValue($para, $argmodif);
        //$statement->bindParam($para, $argmodif);
    }


    //On réalise la requète et on renvoie le résultat
    $liste = null;
    if ($statement->execute()) {
        var_dump($statement);
        $liste = $statement->fetchALL(PDO::FETCH_OBJ);
        //On finie par fermer la ressource
        $statement->closeCursor();
    }
    var_dump($liste);
    return $liste;
}

function getPost($askGet){
    if (isset($_POST[$askGet])) {
        return htmlspecialchars($_POST[$askGet]);
    } else {
        return '';
    }
}

function displayChambre($chambres)
{
    if ($chambres) {
        foreach ($chambres as $chambre) {
            // Afficher
            echo '
        <div class="chambre">
          <img src="images/neptune.png">
          <div class="division">
            <h2>Chambre ' . $chambre->numero . '</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  </p>
            <form action="PageReservation.php" method="POST">
                <input type="hidden" name="numChambre" value="'.$chambre->numero.'">
                <input type="submit" value="Voir les réservations"/>
            </form>
          </div>
        </div>
        ';
        }
    }
    else {
            echo "<p>Aucun résulat</p>";
        }
}
