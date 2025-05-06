<?php
// Initialisation des variables
  if(!empty($_GET['liste']))
  $liste=$_GET['liste'];
else
$liste= '';

// sélection du modèle approprié
if($liste =="clients")
require "modele_clients.php";
else if ($liste == "articles")
require "modele_articles.php";

// Affichage de la vue
require "page.php";