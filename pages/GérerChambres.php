<?php
require 'paterns/Head.php';
//Partie code
if ($admin) {
//On précomplète les clées de la liste assiociative qui sert à autocompléter les champs de la page

    ?>

    <html>
    <body>
    <link rel="stylesheet" href="../css/GérerChambres.css">
    <form enctype="multipart/form-data" action="loginRegister/AjouterChambre.php" method="get">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
        <label for="image">Image : </label> <input id="image" type="file" name="monfichier"
                                                   accept="image/png, image/jpeg" required/>
        <label for="nomChambre">Nom de la chambre : </label> <input id="nomChambre" type="text" name="nomChambre"
                                                                    maxlength="250" minlength="6" required/>
        <label for="tarif">Tarif : </label>
        <select name="tarif_id" id="toto" required>
            <option selected>Sélectionner un prix</option>
            <?php
            $tarifs = getListe($bdd, 'tarifs', Array(), Array(), '*');
            foreach ($tarifs as $prix) {
                echo '<option value="' . $prix->id . '">' . $prix->prix . '€</option>';
            }
            ?>
        </select>
        <label for="capacite">Capacite : </label> <input id="capacite" type="number" name="capacite" min="1" max="200"
                                                         required/>
        <label for="exposition">Exposition : </label> <input id="exposition" type="text" name="exposition"
                                                             maxlength="20" minlength="0" required/>
        <label for="douche">Nombre de douche : </label> <input id="douche" type="number" name="douche" min="0" max="100"
                                                               required/>
        <label for="etage">Nombre d'étage : </label> <input id="etage" type="number" name="etage" min="0" max="100"
                                                            required/>
        <input type="submit" value="Ajouter" class="valider"/>
    </form>
    </body>
    </html>
    <?php

} else {
    afficherErreur("Vous devez être administrateur pour accéder à cette page!");
}


require 'paterns/Foot.php';
?>