<?php
function convertDriveLink($driveUrl)
{
    // Si c'est déjà un lien direct (mp3), on le retourne tel quel
    if (preg_match('/\.mp3($|\?)/i', $driveUrl)) {
        return $driveUrl;
    }

    // Conversion des liens Google Drive
    if (preg_match('/drive\.google\.com\/file\/d\/([^\/]+)/', $driveUrl, $matches)) {
        $fileId = $matches[1];
        return "https://drive.google.com/uc?export=download&id=" . $fileId;
    }

    // Si le lien n'est pas reconnu, on le retourne tel quel
    return $driveUrl;
}

function getMusiques()
{
    try {
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
        $bdd = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', '', $options);

        $albumId = isset($_GET['album']) ? intval($_GET['album']) : 0;

        if ($albumId > 0) {
            $req = $bdd->prepare("SELECT titre, lien_drive, spotify_url FROM musiques WHERE id_album = ?");
            $req->execute([$albumId]);
            $musiques = $req->fetchAll(PDO::FETCH_ASSOC);

            // Convertir les liens Drive après avoir récupéré les données
            foreach ($musiques as &$musique) {
                $musique['lien_drive'] = convertDriveLink($musique['lien_drive']);
            }

            return $musiques;
        }
        return [];
    } catch (Exception $err) {
        error_log('Erreur connexion MySQL : ' . $err->getMessage());
        return [];
    }
}
