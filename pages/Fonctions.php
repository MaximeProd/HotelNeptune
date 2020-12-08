
<?php

function getDataBase() {
    try {
        $bdd = new PDO('mysql2.montpellier.epsi.fr;dbname=espanacultura;charset=utf8;port=5306',
            'rodrigue.cimas', 'mdpmdp', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    } catch (Exception $exception) {
        $bdd = null;
    }
    return $bdd;
}

function getListe(PDO $bdd,$askListe,Array $args = [], $search = False) {


    $query = "SELECT * FROM {$askListe} WHERE 1 ";


    foreach ($args as $key => $arg) {
        $query = "{$query} AND {$key} LIKE :p_{$key} ";
    }


    $statement = $bdd->prepare($query);
    foreach ($args as $key => $arg) {

        if ($search) {
            var_dump($search);
            $arg = $arg . '%';
        }
        $para = ':p_'.$key;
        $statement->bindValue($para, $arg);
    }


    $liste = null;
    if ($statement->execute()) {
        $liste = $statement->fetchALL(PDO::FETCH_OBJ);

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

    function afficherEtudiant($etudiant)
{
    if ($etudiants) {
        foreach ($etudiants as $etudiant) {

            echo '
        <div class="etudiants">
          <img src="images/espanacultura.jpg" width="100">
          <div class="affiche">
            <h2>Etudiant' . $etudiant->id . '</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  </p>
            <form action="Etudiants.php" method="POST">
                <input type="hidden" name="idEtudiant" value="'.$etudiant->id.'">
                <input type="submit" value="Voir les étudiants"/>
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
?>