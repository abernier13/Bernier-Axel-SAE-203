<?php
function getAlbums() {
    try {
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        
        $bdd = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', '', $options);
        
        $req = $bdd->query("SELECT id_album, nom, annee, cover_image, spotify_url, description FROM albums");
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($result)) {
            error_log("Aucun album trouvé dans la base de données");
        }
        
        return $result;
        
    } catch(PDOException $err) {
        error_log("Erreur MySQL : " . $err->getMessage());
        return [];
    }
}

