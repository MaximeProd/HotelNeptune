<?php

require 'paterns/Head.php';
unset($_SESSION["memoryPost"]);



if (isset($bdd)) {
    $search = generateSearch($_POST, Array("id","nom","prenom"));
    $etudiants = getListe($bdd,"professeurs",Array(),$search,'*');
    ?>
       <link rel="stylesheet" href="../css/Professeurs.css">
       <class="cadre">
       <div class="bandeau">
       <table class="Les Professeurs:">
           <thead> 
            <tr>
            <?php
            foreach ($search as $key => $element){
                echo "<th>".ucfirst($key)."</th>";
            }
            ?>

            </tr>
           </thead>
           <thead> 
            <tr>
             <form autocomplete="off" class="" action="index.php" method="post">
                <?php
                foreach ($search as $key => $element){
                    echo "<th><input type='text' name='".$key."' value='".$search[$key]."'></th>";
                }
                }
                ?>
              <th><input type="submit" class="valid" name="" ></th>
              </form>
            </tr>
           </thead>
       </table>
       </div>




