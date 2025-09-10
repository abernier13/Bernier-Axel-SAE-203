-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 26 mai 2025 à 11:49
-- Version du serveur : 5.7.43
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gorillaz_song`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id_album` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artiste` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spotify_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id_album`, `nom`, `artiste`, `annee`, `cover_image`, `spotify_url`, `description`) VALUES
(1, 'Gorillaz', 'Gorillaz', 2001, 'https://store.gorillaz.com/dw/image/v2/BHCC_PRD/on/demandware.static/-/Sites-warner-master/default/dw1c872291/pdp-img-eu/0724353448806.jpg?sw=550&sh=550&sm=fit', 'https://open.spotify.com/intl-fr/album/4tUxQkrduOE8sfgwJ5BI2F', 'Album éponyme du groupe virtuel Gorillaz, mélangeant hip-hop, rock et musique électronique.'),
(2, 'Demon Days', 'Gorillaz', 2005, 'https://m.media-amazon.com/images/I/71M8yXz6o7L.jpg', 'https://open.spotify.com/intl-fr/album/0bUTHlWbkSQysoM3VsWldT', 'Deuxième album studio avec des hits comme \"Feel Good Inc.\" et \"DARE\", plus sombre que le premier.');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_album` int(11) NOT NULL,
  `note` decimal(3,1) DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `date_publication` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_utilisateur`, `id_album`, `note`, `commentaire`, `date_publication`) VALUES
(1, 1, 1, 5.0, 'Excellent, j\'adore le titre Clint-Eastwood.', '2025-05-19 11:21:52'),
(2, 3, 2, 5.0, 'Tu es tendu comme une crampe Natacha !!', '2025-05-19 11:22:30'),
(3, 4, 1, 3.0, 'J\'ai moins aimé cet album que le premier.', '2025-05-19 11:23:44'),
(4, 6, 2, 4.0, 'Album très réussi.', '2025-05-19 14:36:50'),
(5, 5, 1, 4.0, 'J\'adore l\'esthétique de ce premier album !', '2025-05-20 11:16:30'),
(6, 5, 2, 5.0, 'Excellent, j\'adore le Kids With Guns ', '2025-05-26 10:25:27');

-- --------------------------------------------------------

--
-- Structure de la table `musiques`
--

DROP TABLE IF EXISTS `musiques`;
CREATE TABLE `musiques` (
  `id_musiques` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artiste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `lien_drive` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spotify_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_album` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `musiques`
--

INSERT INTO `musiques` (`id_musiques`, `titre`, `artiste`, `album`, `annee`, `lien_drive`, `spotify_url`, `id_album`) VALUES
(1, 'Re-Hash', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/Gorillaz%20-%20Re-Hash%20-%20Gorillaz.mp3', 'https://open.spotify.com/intl-fr/track/0dYN5MqKzCfdpDb1bgvdsm', 1),
(2, '5/4', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/54.mp3', 'https://open.spotify.com/intl-fr/track/5Q10MhatY5DkgBfbWUkRpN', 1),
(3, 'Tomorrow Comes Today', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/Tomorrow%20Comes%20Today.mp3', 'https://open.spotify.com/intl-fr/track/6BL4PpswVjH9BAajbIbpmZ', 1),
(4, 'New Genious (Brother)', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/New%20Genius(Brother).mp3', 'https://open.spotify.com/intl-fr/track/0rOG02q8ocSOeGHWrSAObK', 1),
(5, 'Clint Eastwood', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/ClintEastwood.mp3', 'https://open.spotify.com/intl-fr/track/1RKUoGiLEbcXN4GY4spQDx', 1),
(6, 'Man Research (Clapper)', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/Man%20Research%20(Clapper).mp3', 'https://open.spotify.com/intl-fr/track/0YPyKUa0AgAbt0ZuNWt8vS', 1),
(7, 'Punk', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/Punk.mp3', 'https://open.spotify.com/intl-fr/track/6PuDxX1F5lw3jp6t8FsWvF', 1),
(8, 'Sound Check (Gravity)', 'Gorillaz', 'Gorillaz', 2001, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%201/Sound%20Check%20(Gravity).mp3', 'https://open.spotify.com/intl-fr/track/0HpJb4Lstb9R6wlu2jUBoy', 1),
(9, 'Intro', 'Gorillaz', 'Demon Days', 2005, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%202/Intro.mp3', 'https://open.spotify.com/intl-fr/track/2zavoMfVVPJMikH57fd8yK', 2),
(10, 'Last Living Souls', 'Gorillaz', 'Demon Days', 2005, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%202/Gorillaz%20-%20Last%20Living%20Souls%20-%20Demon%20Days.mp3', 'https://open.spotify.com/intl-fr/track/7JzmCjvB6bk48JghLyrg8N', 2),
(11, 'Kids With Guns', 'Gorillaz', 'Demon Days', 2005, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%202/Gorillaz%20-%20Kids%20With%20Guns%20(Official%20Video).mp3', 'https://open.spotify.com/intl-fr/track/0eEgMbSzOHmkOeVuNC3E0k', 2),
(12, 'O Green World', 'Gorillaz', 'Demon Days', 2005, 'https://github.com/abernier13/Bernier-Axel-SAE-203/raw/refs/heads/main/song/Album%202/Gorillaz%20-%20O%20Green%20World%20-%20Demon%20Days.mp3', 'https://open.spotify.com/intl-fr/track/4hNPMfFHauPIbOKvdYqFt7', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  `role` enum('utilisateur','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `pseudo`, `email`, `date_inscription`, `role`) VALUES
(1, 'Bernier', 'Axel', 'Axelou2', 'axel@bernier.com', '2025-04-30 09:10:40', 'utilisateur'),
(2, 'Gaechter', 'Clement', 'Gaechty06', 'clement@gaechter.com', '2025-04-30 09:18:19', 'utilisateur'),
(3, 'Damiens', 'François', 'Dikenek', 'damiens@notmail.com', '2025-04-30 09:21:00', 'utilisateur'),
(4, 'Ferme', 'Jean', 'Jenjen12', 'ferme@outlook.fr', '2025-04-30 09:35:09', 'utilisateur'),
(5, 'Cash', 'Johnny', 'Johnny66', 'johny@cash.com', '2025-04-30 09:37:50', 'utilisateur'),
(6, 'Bernier', 'Frédéric', 'Fred68', 'fred@notmail.com', '2025-05-03 18:35:12', 'utilisateur'),
(7, 'Corydon', 'Lucie', 'Neuesssss2', 'neue@corydon.fr', '2025-05-05 13:48:24', 'utilisateur'),
(8, 'PANTIUUUK', 'Kika', 'kikapan', 'kikapon@notmail.com', '2025-05-19 11:05:51', 'utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id_album`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD UNIQUE KEY `unique_avis_album` (`id_utilisateur`,`id_album`),
  ADD KEY `id_album` (`id_album`);

--
-- Index pour la table `musiques`
--
ALTER TABLE `musiques`
  ADD PRIMARY KEY (`id_musiques`),
  ADD KEY `fk_album` (`id_album`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `musiques`
--
ALTER TABLE `musiques`
  MODIFY `id_musiques` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `musiques`
--
ALTER TABLE `musiques`
  ADD CONSTRAINT `fk_album` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id_album`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
