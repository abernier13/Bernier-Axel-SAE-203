<?php
require "modele.php";

// Initialisation des variables
$liste = isset($_GET['liste']) ? $_GET['liste'] : 'albums';
$table = [];

// Chargement du modèle approprié
if (!empty($_GET["liste"])) {
    $liste = $_GET["liste"];

    if ($liste == "albums") {
        $table = listeAlbums(); 
    } 
    elseif ($liste == "musiques") {
        if (isset($_GET['idAlbum'])) {
            $idAlbum = $_GET['idAlbum'];
            $table = listeMusiques($idAlbum); 
        } else {
            // Aucun album spécifé --> afficher toutes les musiques des deux albums
            $table = toutesLesMusiques();
        }
    }
} else {
    $liste = '';
}

// Affichage de la vue
require "page.php";
