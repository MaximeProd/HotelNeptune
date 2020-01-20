<?php
echo
'<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hotel Neptune</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Acme|Sniglet&display=swap" rel="stylesheet">
    <!--
    font-family: "Sniglet", cursive; →Titre
    font-family: "Acme", sans-serif; →Texte
  -->
  </head>
  <body>
    <header>
      <div class="haut">
        <img src="../images/neptune.png">
        <h1>Hotel Neptune</h1>
      </div>
    </header>
    <main>
      <div class="liste">
        <li><a href="#">Accueil</a></li>
        <li><a href="#">Mes réservtion</a></li>
        <li><a href="#">Se connecter/Inscription</a></li>
      </div>
      <div class="fake">
        &nbsp
        <div class="chambre">
          <img src="../images/neptune.png">
          <div class="division">
            <h2>Chambre num</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  </p>
            <input type="button" name="Chambe" value="Disponible">
          </div>
        </div>
      </div>
    </main>
    <footer>
      <div class="footer">
        <a href="#">Qui somme-nous? </a>
        <a href="#">Tarif </a>
        <a href="#">Mention légale </a>
        <a href="#">Asssistance </a>
        <a href="#">Fonctionnement Du Site </a>
        <a href="#">Aide </a>
      </div>
      <div class="Copyright">
        <a>©️ Copyright 2019</a>
      </div>
    </footer>
  </body>
</html>
' ?>