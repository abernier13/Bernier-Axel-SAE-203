<?php
require "fonction_page.php";

// Initialisation des chaines de caractères
$albumSpecifique = isset($_GET['albums']) ? $_GET['albums'] : '';
$musiques = isset($_GET['id_album']) ? $_GET['id_album'] : '';


// Récupération des informations de l'album depuis la table albums
$stmtAlbum = $database->prepare("SELECT * FROM albums WHERE nom = :album_nom");
$stmtAlbum->bindParam(':album_nom', $albumSpecifique);
$stmtAlbum->execute();
$album = $stmtAlbum->fetch(PDO::FETCH_ASSOC);
if (empty($albumSpecifique)) {
    echo "Aucun nom d'album spécifié.";
    exit;
}

if ($musiques) {
    // Récupération des chansons de l'album
    $stmtMusiques = $database->prepare("SELECT * FROM musiques WHERE id_album = :id_album");
    $stmtMusiques->bindParam(':id_album', $musiques['id_album']);
    $stmtMusiques->execute();
    $chansons = $stmtMusiques->fetchAll(PDO::FETCH_ASSOC);

    if (empty($musiques)) {
        echo "Aucune chanson trouvée pour cet album.";
        exit;
    }

    $listesong = "";

    foreach ($chansons as $chanson) {
        // Conversion du lien Drive en lien direct jouable
        $driveUrl = $chanson['lien_drive'];
        $directUrl = convertDriveToDirect($driveUrl);

        $spotifyLink = !empty($chanson['spotify_url']) ?
            "<a href='{$chanson['spotify_url']}' class='lien' target='_blank'>{$chanson['titre']}</a>" :
            $chanson['titre'];

        $listesong .= "<div class='div-song'>
            {$spotifyLink}
            <audio controls>
                <source src='{$directUrl}' type='audio/mpeg'>
                Votre navigateur ne supporte pas la lecture audio.
            </audio>
        </div>";
    }

    echo "<main>
    <div class='song'>
        <div class='div-album'>
            <h2>{$musiques['nom']}</h2>
            " . (!empty($musiques['spotify_url']) ?
        "<a href='{$musiques['spotify_url']}' class='link-album' target='_blank'>Écouter sur Spotify</a>" : "") . "
        </div>
        <div class='listesong'>{$listesong}</div>
    </div>
    </main>";
} else {
    echo "L'album spécifié n'existe pas dans la base de données.";
}


// Fonction pour convertir un lien Google Drive en lien direct
function convertDriveToDirect($driveUrl)
{
    // Si c'est déjà un lien direct
    if (strpos($driveUrl, 'https://drive.google.com/uc?') !== false) {
        return $driveUrl;
    }

    // Si c'est un lien de partage standard
    if (preg_match('/\/file\/d\/([^\/]+)/', $driveUrl, $matches)) {
        $fileId = $matches[1];
        return "https://drive.google.com/uc?export=download&id=" . $fileId;
    }

    // Si c'est un lien avec ID
    if (preg_match('/id=([^&]+)/', $driveUrl, $matches)) {
        $fileId = $matches[1];
        return "https://drive.google.com/uc?export=download&id=" . $fileId;
    }

    // Retourne l'URL original si aucun pattern ne correspond
    return $driveUrl;
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gorillaz</title>
    <link rel="stylesheet" href="../Page/page.css?v=<?php echo time(); ?>">
</head>

<body>

    <header>
        <div class="gorillazlogo">
            <a href="../index.php">
                <img src="../img/gorillaz.logo_.white_.png" alt="Logo Gorillaz">
            </a>
        </div>
        <div class="flexnav">
            <a href="../Page/page.php" class="discographie nav">DISCOGRAPHIE</a>
        </div>
        <div class="flexnav">
            <a href="https://www.gorillaz.com/" target="_blank" class="a nav">SITE OFFICIEL</a>
        </div>
        <div class="flexnav">
            <a href="https://www.instagram.com/gorillaz/?hl=en" class="subscribe nav" target="_blank">FOLLOW
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 50 50">
                    <path
                        d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                    </path>
                </svg>
            </a>
        </div>

        <div class="inscription">
            <a href="../Page/signup.php" class="a-inscr">SIGN UP
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                    <circle cx="12" cy="10" r="3" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </a>
            <div class="dropdown-content">
                <a href="../Page/Formulaire/signup.php">S'inscrir</a>
                <a href="../Page/Formulaire/connexion.php">Se connecter</a>
            </div>
        </div>
    </header>


    <main>

    </main>

    <!--<script src="../js/data.js"></script>
    <script src="../js/script.js"></script>-->
    <footer>
        <div class="cerclesvg" id="section1">
            <a href="#section1">
                <svg class="white-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="31" height="31"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v13m0-13 4 4m-4-4-4 4" />
                </svg>
            </a>
        </div>
    </footer>
</body>



</html>