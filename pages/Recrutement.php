<?php

echo'

<label for="nom">Nom</label>     <input type="text" name="nom"   value="' . $professeur->nom . '" placeholder="Nom"   maxlength="100" minlength="3" required>
<label for="prenom">Prénom</label>           <input type="text" name="prenom"     value="' . $professeur->prenom . '"    placeholder="Prénom"  maxlength="70"  minlength="3" required>
          <div class="niveau"><label for="A1">A1</label>
          <input value="A1" checked     type="radio" name="niveau">
         <div class="niveau"><label for="A2">A2</label>
          <input value="A2" checked     type="radio" name="niveau">
          <div class="niveau"><label for="B1">B1</label>
          <input value="B1" checked     type="radio" name="niveau">
          <div class="niveau"><label for="B2">B2</label>
          <input value="B2" checked     type="radio" name="niveau">
          <div class="niveau"><label for="C1">C1</label>
          <input value="C1" checked     type="radio" name="niveau">
          <div class="niveau"><label for="C2">C2</label>
          <input value="C2" checked     type="radio" name="niveau">
           <input id="Postuler" type="submit" name="" value="Postulez !">
            ';


