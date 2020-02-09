
<?php
//Session :
//https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql/4239476-session-cookies
//Array :
//https://www.php.net/manual/fr/control-structures.foreach.php
//Récupérer donnée column
//https://www.php.net/manual/fr/pdostatement.getcolumnmeta.php
//Récupérer entre parenthèse
//https://www.developpez.net/forums/d1469403/php/langage/recuperer-chaine-entre-parentheses/
//https://www.developpez.net/forums/d812317/bases-donnees/oracle/outils/sql-plus/connaitre-type-champs-d-table/
/*
function getDataBase() {
    try {
        $bdd = new PDO('mysql:host=mysql.montpellier.epsi.fr;dbname=bddneptune;charset=utf8;port=5206;',
            'maxime.bourrier', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

*/
function getDataBase() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=bddneptune;charset=utf8',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}


function getListe(PDO $bdd,$fromTable,Array $cond = [],Array $condLike = [],$askSelect = '*',$specialCond= "") { //Cond pour Condition
    //Pour utiliser cette fonction il faut lui envoyer :
    //La bdd
    //Le(s) table au quel on veux accéder
    //Une liste des condtions à récupérer tel que :
    // array(arg1 => value1, arg2 => value 2, etc)
    //Il est possible de demander les conditions avec like aussi
    //Avec un exemple :
    // array( 'idClient' => 15, 'prenom' => 'Maxime')
    $query = "SELECT {$askSelect} FROM {$fromTable} WHERE 1 ";
    //Etape 1 : On génère la requête sql avec les arguments demandés :
    foreach ($cond as $key => $arg) {
        $query = "{$query} AND {$key} = :p_{$key} ";
    }
    foreach ($condLike as $key2 => $arg2) {
        $query = "{$query} AND {$key2} LIKE :p_{$key2} ";
    }
    if (!empty($specialCond)){
        $query = "{$query} AND {$specialCond}";
    }
    //Affectation des paramètres (Pour rappel les paramètres (p_arg) sont une sécuritée)
    $statement = $bdd->prepare($query);
    foreach ($cond as $key => $arg) {
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }
    foreach ($condLike as $key => $arg) {
        $arg = $arg . '%';
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }
    //var_dump($statement);
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
    // array( 'nom' => Bourrier, 'prenom' => 'Maxime')
    //ET AUSSI il faut donner l'id de l'éllement à modife
    //var_dump($idModif);
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
    //var_dump($statement);
    //On réalise l'update
    $statement->execute();
    $statement->closeCursor();
}




function insertListe(PDO $bdd,$toTable,Array $args) {
    //Pour utiliser cette fonction il faut lui envoyer :
    //La bdd
    //Le(s) table au quel on veux insérer
    //Une liste des insertion à faire :
    // array(arg1 => modif1, arg2 => modif2, etc)
    //Avec un exemple :
    // array( 'idClient' => 15, 'prenom' => 'Maxime')
    $tableValues = '';
    $values = '';
    foreach ($args as $key => $arg) {
        $tableValues = "{$tableValues},{$key}";
        $values = "{$values},:p_{$key}";
    }
    $query = "INSERT INTO {$toTable}(id{$tableValues}) VALUES (null{$values}) ";
    //Affectation des paramètres (Pour rappel les paramètres (p_arg) sont une sécuritée)
    $statement = $bdd->prepare($query);
    foreach ($args as $key => $arg) {
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }
    //var_dump($statement);
    //On réalise l'insertion
    $statement->execute();
    $statement->closeCursor();
}















//Fonction utilitaire :
function extractFromParenthese($string){
    $tmp1 = strrchr($string, '(');
    $extract = substr($tmp1, 0, strpos($tmp1, ')') + 1);
    $extract = str_replace(array( "(", ")"), "", $extract);
    return $extract;
}


function getPost($askGet){
    if (isset($_POST[$askGet])) {
        return htmlspecialchars($_POST[$askGet]);
    } else {
        return '';
    }
}

function afficherErreur($erreur = null){
    if (isset($_SESSION["erreur"])){
        $valueErreur = $_SESSION["erreur"];
        if ($valueErreur  == 1){
            $erreur = 'Veuillez contacter l\'administrateur dès les plus bref délai!!';
        } elseif ($valueErreur  == 2) {
            $erreur = 'Mot de passe ou email incorrect';
        } elseif ($valueErreur  == 3) {
            $erreur = 'Email incorrect';
        } elseif ($valueErreur  == 4) {
            $erreur = 'Les mots de passe ne corresponde pas';
        } elseif ($valueErreur  == 5) {
            $erreur = 'Email déjà utilisé';
        } elseif ($valueErreur  == 6) {
        $erreur = 'Champ obligatoire incomplet';
        } elseif ($valueErreur  == 7) {
            $erreur = 'Serveur introuvable!';
        }
        unset($_SESSION["erreur"]);
    }
    if (isset($erreur)){
        echo '
          <div class="erreur">
            <p>' . $erreur . '</p>
          </div>
          ';
    }
}

function generateSearch(Array $listePOST = [], Array $askSearch = []){
    $search = Array();
    if (isset($listePOST)){
        $listeElement = $askSearch;
        foreach ($listeElement as $item) {
            if (isset($listePOST[$item])){
                $search += [$item => $listePOST[$item]];
            }   else {
                $search += [$item => ""];
            }
        }
    }
    return $search;
}

/*
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
*/

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

/*
//Fonction pour encrypter un mot de passe
var_dump($_POST);
$bdd = getDataBase();
$cryptPassword = password_hash('motdepasse',PASSWORD_DEFAULT);
updateListe($bdd,'membres',Array('mdp'=>$cryptPassword),161);
*/


//TEST CHECK ATRIBUTE COLONNE SQL
/*
$liste = getListe($bdd,'membres');
$select = $bdd->query('SELECT * FROM membres WHERE id = 1');
for ($i =0; $i < $select->columnCount();$i++){
    $test = $select->getColumnMeta($i);
    var_dump($test['len']);
    var_dump($test['name']);
}
$test2 = $select->getAttribute('email');
var_dump($test);
var_dump($test2);
*/

/* Projet arrêter : objectif automatisé la génration des inputs
//On récupe les caractéristique des colonnes
$select = $bdd->query('DESCRIBE membres');
$columns = $select->fetchAll();
//On en extrait les valeur utilies pour leurs complétion tel que la taille max ou leur nom
foreach ($columns as $column) {
    $sizeColumn[$column["Field"]] = extractFromParenthese($column["Type"]);
}
*/

/* RENAME CHAMBRE
$personnes = getListe($bdd,"chambres");
foreach ($personnes as $personne){
    $id = $personne-> numero;
    $nomchambre = "'Chambre ".$id."'";
    $query = "update chambres set nomChambre={$nomchambre} where numero={$id}";
    var_dump($query);
    $statement = $bdd->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}
*/