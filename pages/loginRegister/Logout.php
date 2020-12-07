<?php
session_start();
session_destroy();
header('Location: ../index.php');
//on revient  a la page d'accueil