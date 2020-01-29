
<?php
//Session :
//https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/4239476-session-cookies
//Array :
//https://www.php.net/manual/fr/control-structures.foreach.php
function getDataBase() {
    try {
        $bdd = new PDO('mysql:host=mysql.montpellier.epsi.fr;dbname=bddneptune;charset=utf8;port=5206',
            'maxime.bourrier', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function getListe(PDO $bdd,$fromTable,Array $args = [],$askSelect = '*', $search = False) {
    //Pour utiliser cette fonction il faut lui envoyer :
    //La bdd
    //Le(s) table au quel on veux accéder
    //Une liste des condtions à récupérer tel que :
    // array(arg1 => value1, arg2 => value 2, etc)
    //Avec un exemple :
    // array( 'idClient' => 15, 'prenom' => 'Maxime')

    $query = "SELECT {$askSelect} FROM {$fromTable} WHERE 1 ";
    //var_dump($query);

    //Etape 1 : On génère la requête sql avec les arguments demandés :
    foreach ($args as $key => $arg) {
        $query = "{$query} AND {$key} LIKE :p_{$key} ";
    }
    //Affectation des paramètres (Pour rappel les paramètres (p_arg) sont une sécuritée)

    $statement = $bdd->prepare($query);
    foreach ($args as $key => $arg) {

        if ($search) {
            //var_dump($search);
            $arg = $arg . '%';
        }
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }

    //On réalise la requète et on renvoie le résultat
    $liste = null;
    if ($statement->execute()) {
        $liste = $statement->fetchALL(PDO::FETCH_OBJ);
        //On finie par fermer la ressource
    }
    $statement->closeCursor();
    return $liste;
}

function updateListe(PDO $bdd,$fromTable,Array $args,$idModif) {
    //Pour utiliser cette fonction il faut lui envoyer :
    //La bdd
    //Le(s) table au quel on veux accéder
    //Une liste des modifs à faire :
    // array(arg1 => modif1, arg2 => modif2, etc)
    //Avec un exemple :
    // array( 'idClient' => 15, 'prenom' => 'Maxime')
    //ET AUSSI il faut donner l'id de l'éllement à modife
    var_dump($idModif);
    $query = "UPDATE {$fromTable} SET id={$idModif} ";
    //Etape 1 : On génère la requête sql avec les arguments demandés :
    foreach ($args as $key => $arg) {
        $query = "{$query} , {$key} = :p_{$key} ";
    }
    $query = "{$query} WHERE id = {$idModif}";
    //Affectation des paramètres (Pour rappel les paramètres (p_arg) sont une sécuritée)
    $statement = $bdd->prepare($query);
    //$statement->bindValue(':p_id', $idModif);
    foreach ($args as $key => $arg) {
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }
    var_dump($statement);
    //On réalise l'update
    $statement->execute();
    $statement->closeCursor();
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
        </div>
        ';
        }
    }
    else {
            echo "<p>Aucun résulat</p>";
        }
}


/*
 Générateur d'email
foreach ($personnes as $personne){
    $id = $personne-> id;
    $email = mb_strtolower($personne-> prenom) .'-'. strtolower($personne-> nom) .'-'. $personne-> id.'@fakemail.fr';
    $query = "update membres set email='{$email}' where id=".$id;
    var_dump($query);

    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();


}
*/