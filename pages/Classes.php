<?php
require 'paterns/Head.php';

if (isset($bdd)){
    if ($id !=0) {
        $Titre = "Les Classes : ";
        $search = Array();

        if (isset($_POST)){
            $listeClasse= Array('id','nom');
            foreach ( $listeClasse as $classe) {
                if (isset($_POST[$classe])){
                    $search += [$classe => $_POST[$classe]];
                }   else {
                    $search += [$classe => ""];
                }
            }
            if (!empty($_POST['selectclasse'])) {
                $id = $_POST['selectclasse'];
                $fullClasse = getListe($bdd, 'classe',Array('id'=>$id),Array(),'nom');
                $fullClasse = $fullClasse[0];

            }
        }

        $classe = getListe($bdd,'classe',Array('id'=>$id),Array('nom'=>$search['nom']));
        if ($search["previewNum"] != ""){
            $preview = getListe($bdd,'classe',Array('id'=>$id),Array('nom'=>$search['nom']));
            $preview = $preview[0];


            echo '
     
           <div class="etudiant">
          <img src="images/espanacultura.jpg>
           <h2>' . $preview->nometudiant.'</h2>
           
       
           
            <p>Id : ' . $preview->id . ' €</p>
            <p>Classe : ' . $preview->classe .'</p>
            <p>Nom: ' .$preview->nom.'</p>
            <p>Prénom: ' .$preview->prenom .'</p>
            <p>Id Classe: ' .$preview->id_classe .'</p>
          
          </div>
        </div>
        ';
    }






    echo  '   
           
           <table>
              <caption>'.$Titre.'</caption>
               <thead> 
                <tr> 
                    <th>Nom</th>
                    <th>Prénom</th>
                </tr>
               </thead>
               <thead> 
                <tr>
                  <form autocomplete="off" class="" action="Classe.php" method="post">
                  <th><input type="text" name="nom" value="'.$search['nom'].'"></th>
                  <th><input type="text" name="prenom" value="'.$search['prenom'].'"></th>
                  <input type="hidden" name="idetudiant" value="'.$id.'">
                  <th><input type="submit" class="rechercher" value="Rechercher"></th>
                  </form> 
                </tr>
               </thead>
              ';
        if(!empty($etudiants)) {
            foreach ($etudiants as $etudiant) {
                echo
                    '<tbody>
                    <tr>
                    <td>'.$etudiants->nometudiant.'</td>
                    <td>'.$etudiant->prenom.'</td>
                   <td><form class="classe" action="Classe.php" method="post"><input type="hidden" name="previewNum" value="'.$etudiant->id.'">
                   <td><input type="hidden" name="selectclient" value="'.$idetudiant.'"></td>
                        </tr>
                    </tbody>';
            }
        }else{
        echo'<tbody><tr><td class="nul">Aucun résultat</td></tr></tbody>';
        }
        echo '
            </table>
        </table>';

    } else {
    afficherErreur('Vous devez être connecté pour voir les classes : <a href="Inscriptions.php"> > Page connexion < </a>');
    }
}

require 'paterns/Foot.php';
?>