<?php
require "modele.php";

// Initialisation des variables
$liste = 'albums'; // Valeur par défaut définie à 'albums'
$table = [];

// Gestion du tri (ASC par défaut, DESC si demandé)
if (isset($_GET['abc'])) {
    $abc = ($_GET['abc'] === 'desc') ? 'DESC' : 'ASC';
} else {
    $abc = 'ASC'; // Valeur par défaut
}

// 
if (!empty($_GET["liste"])) {
    $liste = $_GET["liste"];

    if ($liste == "musiques") {
        if (isset($_GET['idAlbum'])) {  // récupère les musiques de l'album spécifique
            $idAlbum = $_GET['idAlbum'];
            $table = listeMusiques($idAlbum);
        } else {
            // Aucun album spécifié --> afficher toutes les musiques des deux albums
            $table = toutesLesMusiques($abc);
        }
    }
}

// Par défaut, on charge les albums si $liste est vide ou égale à albums
if ($liste == 'albums') {
    $table = listeAlbums();
}

// Affichage de la vue
require "page.php";
