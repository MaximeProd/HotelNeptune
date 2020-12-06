
<?php
//Session :
//https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/4239476-session-cookies
//Array :
//https://www.php.net/manual/fr/control-structures.foreach.php
function getDataBase() {
    try {
        $bdd = new PDO('mysql:host=mysql2.montpellier.epsi.fr;dbname=espanacultura;charset=utf8;port=5306',
            'rodrigue.cimas', '864AC0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function getListe(PDO $bdd,$askListe,Array $args = [], $search = False) {
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

    $statement = $bdd->prepare($query);
    foreach ($args as $key => $arg) {

        if ($search) {
            var_dump($search);
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
        $statement->closeCursor();
    }
    return $liste;
}

function getPost($askGet){
    if (isset($_POST[$askGet])) {
        return htmlspecialchars($_POST[$askGet]);
    } else {
        return '';
    }
}

function displayEtudiant($etudiant)
{
    if ($etudiant) {
        foreach ($etudiant as $etudiants)
            // Afficher
            echo '
        <div class="chambre">
          
          <div class="division">
            <h2>Chambre ' . $etudiant->nom . '</h2>
            <p> wesh</p>
            <form action="PageReservation.php" method="POST">
                <input type="hidden" name="nomEtudiant" value="'.$etudiant->nom.'">
                <input type="submit" value="Voir les réservations"/>
            </form>
          </div>
        </div>
        ';
        }

    else {
            echo "<p>Aucun résulat</p>";
        }
}
