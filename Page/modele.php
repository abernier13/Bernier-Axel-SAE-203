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
  try   // Connexion à la base de données
  {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', 'root', $options);
  } catch (Exception $err) {
    die('Erreur connexion MySQL : ' . $err->getMessage());
  }

  // Envoi de la requête SQL pour récupérer la liste des albums
  $reponse = $bdd->query("SELECT id_album, nom, annee, cover_image, spotify_url, description FROM albums;");

  // Lecture de toutes les lignes de la réponse dans un tableau associatif
  $albums = $reponse->fetchAll(PDO::FETCH_ASSOC);

  $bdd = null;                // Fin de la connexion

  return $albums;
}





/*******************************************************
Retourne la liste des musiques d'un album spécifique
  Entrée : 
    [int] $idAlbum : Identifiant de l'album
  
  Retour : 
    [array] : Tableau associatif contenant la liste des musiques
 *******************************************************/
function listeMusiques($idAlbum)
{
  try   // Connexion à la base de données
  {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', 'root', $options);
  } catch (Exception $err) {
    die('Erreur connexion MySQL : ' . $err->getMessage());
  }

  // Envoi de la requête SQL pour récupérer les musiques de l'album
  $requete = $bdd->prepare("SELECT titre, lien_drive, spotify_url FROM musiques WHERE id_album = ?;");
  $requete->execute(array($idAlbum));

  // Lecture de toutes les lignes de la réponse dans un tableau associatif
  $musiques = $requete->fetchAll(PDO::FETCH_ASSOC);

  // Conversion des liens Drive
  foreach ($musiques as &$musique) {
    $musique['lien_drive'] = convertirLienDrive($musique['lien_drive']);
  }

  $bdd = null;                // Fin de la connexion

  return $musiques;
}





/*******************************************************
Convertit un lien Google Drive en lien direct téléchargeable
  Entrée : 
    [string] $lien : Lien à convertir
  
  Retour : 
    [string] : Lien converti ou original si non convertible
 *******************************************************/
function convertirLienDrive($lien)
{
  // Si c'est déjà un lien direct (mp3), on le retourne tel quel
  if (preg_match('/\.mp3($|\?)/i', $lien)) {
    return $lien;
  }

  // Conversion des liens Google Drive
  if (preg_match('/drive\.google\.com\/file\/d\/([^\/]+)/', $lien, $matches)) {
    $fileId = $matches[1];
    return "https://drive.google.com/uc?export=download&id=" . $fileId;
  }

  // Si le lien n'est pas reconnu, on le retourne tel quel
  return $lien;
}







/*******************************************************
Retourne la liste de toutes les musiques de tous les albums
  Entrée : 
  
  Retour : 
    [array] : Tableau associatif contenant toutes les musiques
 *******************************************************/
function toutesLesMusiques()
{
  try   // Connexion à la base de données
  {
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    $bdd = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', 'root', $options);
  } catch (Exception $err) {
    die('Erreur connexion MySQL : ' . $err->getMessage());
  }

  // Envoi de la requête SQL pour récupérer toutes les musiques
  // utilisation d'alias pour simplifier la lecture et éviter les ambiguïtés
  // INNER JOIN pour lier les musiques aux albums
  $reponse = $bdd->query("SELECT m.titre, m.lien_drive, m.spotify_url, a.nom AS album 
FROM musiques m 
INNER JOIN albums a ON m.id_album = a.id_album;");

  // Lecture de toutes les lignes de la réponse dans un tableau associatif
  $musiques = $reponse->fetchAll(PDO::FETCH_ASSOC);

  // Conversion des liens Drive
  foreach ($musiques as &$musique) {
    $musique['lien_drive'] = convertirLienDrive($musique['lien_drive']);
  }

  $bdd = null;                // Fin de la connexion

  return $musiques;
}
