<?php
require "modele.php";

// Initialisation des variables
$liste = 'albums'; // Valeur par défaut définie à 'albums'
$table = [];

// Chargement du modèle approprié
if (!empty($_GET["liste"])) {
    $liste = $_GET["liste"];

    if ($liste == "musiques") {
        if (isset($_GET['idAlbum'])) {
            $idAlbum = $_GET['idAlbum'];
            $table = listeMusiques($idAlbum);
        } else if (isset($_GET['album'])) {  // Correction: utiliser 'album' comme dans page.php
            $idAlbum = $_GET['album'];
            $table = listeMusiques($idAlbum);
        } else {
            // Aucun album spécifié --> afficher toutes les musiques des deux albums
            $table = toutesLesMusiques();
        }
    }
}

// Par défaut, on charge les albums si $liste est vide ou égale à 'albums'
if ($liste == 'albums') {
    $table = listeAlbums();
}

// Affichage de la vue
require "page.php";
