<?php
require 'paterns/Head.php';
//Partie code
if ($admin) {

//On précomplète les clées de la liste assiociative qui sert à autocompléter les champs de la page

    $bouttonModif = "Ajouter";

    if (!isset($_SESSION['saveEtudiant'])){
        $save = generateSearch($_POST, Array('id','id_classe','nom','prenom','ID_classe_Se_trouve'));

        if ($save['modif'] != ""){

            $etudiants = getListe($bdd,"etudiant",Array("id"=>$save['modif']),Array(),'*');
            $etudiants = $etudiants[0];
            $titre = "Modification du étudiant id :".$etudiants->$id." alias ".$etudiants->nom;
            $bouttonModif = "Modifier";
            foreach ($save as $key => $item){
                if ($key != "modif"){
                    $save[$key] = $etudiants>$key;
                }

            }
        }
    } else {
        $save = $_SESSION['saveEtudiant'];
        unset($_SESSION['saveEtudiant']);
    }


    echo'
    <html>
    <body>
    <h5>Modifier des étudiants</h5>
    
    
        <input type="hidden" name="modif" value="'.$save['modif'].'" />
        <label for="nomEtudiant">Nom du étudiant : </label> <input id="nomEtudiant" type="text" value="'.$save['nomEtudiant'].'" name="nomEtudiant" maxlength="250" minlength="6" required/>
        <label for="prenom">Prénom : </label> <input id="prenom" type="text" value="'.$save['prenom'].'" name="prenom" maxlength="250" minlength="6" required/>
       <label for="capacite">Classe : </label>  <input id="classe" type="number"  value="'.$save['classe'].'" name="classe" min="1" max="80" required/>
 
        <input type="submit" value="'.$bouttonModif.'" class="valider">
           
';

    $etudiants = getListe($bdd, 'etudiant', Array(), '*');
            foreach ($etudiants as $id) {
                $selected = "";
                if ( $nom->id == $save['etudiant_id']) {
                    $selected = "selected";
                }


            }
            echo'
      
        
    </form>
    </body>
    </html>
    ';

} else {
    afficherErreur("Vous devez être administrateur pour accéder à cette page!");
}


require 'paterns/Foot.php';
?>