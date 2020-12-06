<?php
require 'paterns/Head.php';
//Partie code
if ($admin) {

//On précomplète les clées de la liste assiociative qui sert à autocompléter les champs de la page
    $titre = "Ajout d'une chambre";
    $bouttonModif = "Ajouter";

    if (!isset($_SESSION['saveChambre'])){
        $save = generateSearch($_POST, Array('modif','nomChambre','tarif_id','capacite','exposition','douche','etage'));
        //var_dump($save);
        if ($save['modif'] != ""){
            //var_dump($save['modif']);
            $chambres = getListe($bdd,"chambres,tarifs",Array("numero"=>$save['modif']),Array(),'*',"tarif_id=id");
            $chambres = $chambres[0];
            $titre = "Modification de la chambre n°".$chambres->numero." alias ".$chambres->nomChambre;
            $bouttonModif = "Modifier";
            foreach ($save as $key => $item){
                if ($key != "modif"){
                    $save[$key] = $chambres->$key;
                }

                //var_dump($save[$key]);

            }
        }
    } else {
        $save = $_SESSION['saveChambre'];
        unset($_SESSION['saveChambre']);
    }


    echo'
    <html>
    <body>
    <h5>'.$titre.'</h5>
    <link rel="stylesheet" href="../css/GérerChambres.css">
    <form enctype="multipart/form-data" action="loginRegister/AjouterChambre.php" method="post">
        <input type="hidden" name="modif" value="'.$save['modif'].'" />
        <input id="image" type="hidden" name="monfichier" accept="image/png, image/jpeg"/>
        <label for="nomChambre">Nom de la chambre : </label> <input id="nomChambre" type="text" value="'.$save['nomChambre'].'" name="nomChambre" maxlength="250" minlength="6" required/>
        <label for="tarif">Tarif : </label>
        <select name="tarif_id" id="toto" required>
            <option >Sélectionner un prix</option>
';

            $tarifs = getListe($bdd, 'tarifs', Array(), Array(), '*');
            foreach ($tarifs as $prix) {
                $selected = "";
                if ( $prix->id == $save['tarif_id']){
                    $selected = "selected";
                }
                echo '<option value="' . $prix->id . '" ' .$selected.'>' . $prix->prix . '€</option>';

            }
            echo'
        </select>
        <label for="capacite">Capacite : </label>       <input id="capacite" type="number"  value="'.$save['capacite'].'" name="capacite" min="1" max="200" required/>
        <label for="exposition">Exposition : </label>   <input id="exposition" type="text"  value="'.$save['exposition'].'" name="exposition" maxlength="20" minlength="0" required>
        <label for="douche">Nombre de douche : </label> <input id="douche" type="number"    value="'.$save['douche'].'" name="douche" min="0" max="100" required>
        <label for="etage">Nombre d\'étage : </label>   <input id="etage" type="number"     value="'.$save['etage'].'" name="etage" min="0" max="100" required>
        <input type="submit" value="'.$bouttonModif.'" class="valider">
    </form>
    </body>
    </html>
    ';

} else {
    afficherErreur("Vous devez être administrateur pour accéder à cette page!");
}


require 'paterns/Foot.php';
?>