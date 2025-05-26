<?php
// ****** ACCES AUX DONNEES ******

/*******************************************************
Retourne la liste des albums 
  Entrée : 
  
  Retour : 
    [array] : Tableau associatif contenant la liste des albums
 *******************************************************/
function listeAlbums()
{
  try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO(
      'mysql:host=iutmmmisql01.uha.fr;dbname=e2402726', 
      'e2402726', 
      '516933', 
      $options
    );
  } catch (Exception $err) {
    die('Erreur connexion MySQL : ' . $err->getMessage());
  }

  $reponse = $bdd->query("SELECT id_album, nom, annee, cover_image, spotify_url, description FROM albums;");
  $albums = $reponse->fetchAll(PDO::FETCH_ASSOC);

  $bdd = null;
  return $albums;
}





/*******************************************************
Retourne la liste des musiques d'un album spécifique
  Entrée : 
    [int] $idAlbum : Identifiant de l'album
  
  Retour : 
    [array] : Tableau associatif contenant la liste des musiques
 *******************************************************/
function listeMusiques($idAlbum, $abc = 'ASC')
{
  try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO(
      'mysql:host=iutmmmisql01.uha.fr;dbname=e2402726', 
      'e2402726', 
      '516933', 
      $options
    );

    if ($abc === 'DESC') {
      $abcValide = 'DESC';
    } else {
      $abcValide = 'ASC';
    }
    $idAlbum = intval($idAlbum); // Sécurisation minimale

    $sql = "SELECT titre, lien_drive, spotify_url 
            FROM musiques 
            WHERE id_album = $idAlbum
            ORDER BY titre $abcValide";

    $reponse = $bdd->query($sql);
    $musiques = $reponse->fetchAll(PDO::FETCH_ASSOC);

    $bdd = null;
    return $musiques;
  } catch (Exception $err) {
    die('Erreur MySQL : ' . $err->getMessage());
  }
}



/*******************************************************
Retourne la liste de toutes les musiques de tous les albums
  Entrée : 
    [string] $abc : Ordre de tri ('ASC' ou 'DESC')
  
  Retour : 
    [array] : Tableau associatif contenant toutes les musiques
 *******************************************************/
function toutesLesMusiques($abc = 'ASC')
{
  try {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO(
      'mysql:host=iutmmmisql01.uha.fr;dbname=e2402726', 
      'e2402726', 
      '516933', 
      $options
    );

    if ($abc === 'DESC') {
      $abcValide = 'DESC';
    } else {
      $abcValide = 'ASC';
    }

    $sql = "SELECT m.titre, m.lien_drive, m.spotify_url, a.nom AS album 
            FROM musiques m 
            INNER JOIN albums a ON m.id_album = a.id_album
            ORDER BY m.titre $abcValide";

    $reponse = $bdd->query($sql);
    $musiques = $reponse->fetchAll(PDO::FETCH_ASSOC);

    $bdd = null;
    return $musiques;
  } catch (Exception $err) {
    die('Erreur MySQL : ' . $err->getMessage());
  }
}
