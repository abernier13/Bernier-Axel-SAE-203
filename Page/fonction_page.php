<?php
function connexionBDD()
{
try // Connexion à la base de données
{
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
$database = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', 'root', $options);
}
catch(Exception $err)
{
die('Erreur connexion MySQL : ' . $err->getMessage());
}
return $database;
}

function lectureBDD($requete)
{
  $bdd=connexionBDD();      // Connexion à la base de données

  $reponse=$bdd->query($requete);    // Envoi de la requête SQL

  // Lecture de toutes les lignes de la réponse dans un tableau associatif
  $tableau=$reponse->fetchAll(PDO::FETCH_ASSOC);

  $bdd=null;                // Fin de la connexion

  return $tableau;          // Renvoi du tableau associatif
}

function ecritureBDD($requete)
{
  $bdd=connexionBDD();      // Connexion à la base de données

  $nb=$bdd->exec($requete);    // Exécution de la requête SQL

  return $nb;          // Renvoi du résultat de la requête
}