<?php
try // Connexion à la base de données
{
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
$database = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', '', $options);
}
catch(Exception $err)
{
die('Erreur connexion MySQL : ' . $err->getMessage());
}

 // Envoi de la requête SQL 
 $reponse = $bdd->query("SELECT titre, lien_drive, spotify_url FROM musiques;");

 // Lecture de toutes les lignes de la réponse dans un tableau associatif
 $table = $reponse->fetchAll(PDO::FETCH_ASSOC);

 $bdd = null;                // Fin de la connexion


