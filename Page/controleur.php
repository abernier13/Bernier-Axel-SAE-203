<?php
// Initialisation des variables
$liste = isset($_GET['liste']) ? $_GET['liste'] : 'albums';
$table = [];

// Chargement du modèle approprié
if ($liste == "albums") {
    require "modele_albums.php";
    $table = getAlbums(); 
} 
elseif ($liste == "musiques") {
    require "modele_musiques.php";
    $table = getMusiques(); 
}

// Affichage de la vue
require "page.php";