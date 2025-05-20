<?php
$menu = "<a class='lien' href='controleur.php?liste=albums'>Albums</a>
<a class='lien' href='controleur.php?liste=musiques'>Titres</a>";

// Initialisation des variables
$titre = "";
$contenu = "";

// Déterminer ce qu'il faut afficher
$liste = isset($_GET['liste']) ? $_GET['liste'] : 'albums';

// Charger les données appropriées
require_once "modele.php";

if ($liste == "albums") {
    // AFFICHAGE DES ALBUMS
    $albums = listeAlbums();

    $titre = "<div class='titrealb'><h3>Liste des albums</h3></div>";
    $contenu = "<div class='albums-container'>";

    if (!empty($albums)) {
        foreach ($albums as $album) {
            $contenu .= "
            <div class='album-card'>
                <img src='{$album['cover_image']}' alt='{$album['nom']}'>
                <h4>{$album['nom']}</h4>
                <p>Année: {$album['annee']}</p>
                <p>Description: {$album['description']}</p>
                <a href='{$album['spotify_url']}' class='bouton' target='_blank'>Écouter</a>
                <a href='controleur.php?liste=musiques&album={$album['id_album']}' class='bouton'>Voir les titres</a>
            </div>";
        }
    } else {
        $contenu .= "<p>Aucun album trouvé</p>";
    }
    $contenu .= "</div>";
} elseif ($liste == "musiques") {
    // AFFICHAGE DES MUSIQUES
    $titre = "<h3>Liste des titres</h3>";

    if (isset($_GET['album'])) {
        // Musiques d'un album spécifique
        $idAlbum = intval($_GET['album']);
        $musiques = listeMusiques($idAlbum);
        $albumInfo = null;

        // Récupérer les infos de l'album
        $tousAlbums = listeAlbums();
        foreach ($tousAlbums as $album) {
            if ($album['id_album'] == $idAlbum) {
                $albumInfo = $album;
                break;
            }
        }

        $contenu = "<div class='song'>";
        if ($albumInfo) {
            $contenu .= "<div class='div-album'>";
            $contenu .= "<a href='" . $albumInfo['spotify_url'] . "' class='link-album' target='_blank'>" . $albumInfo['nom'] . "</a>";
            $contenu .= "</div>";
        }

        if (!empty($musiques)) {
            foreach ($musiques as $musique) {
                $contenu .= "
                <div class='div-song'>
                    <span class='titre'>" . $musique['titre'] . "</span>
                    <audio controls>
                        <source src='" . $musique['lien_drive'] . "' type='audio/mpeg'>
                        Votre navigateur ne supporte pas l'audio.
                    </audio>
                    <a href='" . $musique['spotify_url'] . "' class='lien' target='_blank'>Écouter sur Spotify</a>
                </div>";
            }
        } else {
            $contenu .= "<p>Aucun titre trouvé pour cet album</p>";
        }
        $contenu .= "</div>";
    } else {
        // Toutes les musiques
        $musiques = toutesLesMusiques();
        $contenu = "<div class='song'>";

        if (!empty($musiques)) {
            foreach ($musiques as $musique) {
                $contenu .= "
                <div class='div-song'>
                    <span class='titre'>" . $musique['titre'] . " (" . $musique['album'] . ")</span>
                    <audio controls>
                        <source src='" . $musique['lien_drive'] . "' type='audio/mpeg'>
                        Votre navigateur ne supporte pas l'audio.
                    </audio>
                    <a href='" . $musique['spotify_url'] . "' class='lien' target='_blank'>Écouter sur Spotify</a>
                </div>";
            }
        } else {
            $contenu .= "<p>Aucun titre trouvé</p>";
        }
        $contenu .= "</div>";
    }
}




//Le formulaire
require "../Page/Formulaire/fonction_form.php";

$resultat = "";
$erreur = "";
if (isset($_POST["pseudo"])) {
    $pseudo = $_POST["pseudo"];
} else {
    $pseudo = '';
}

if (isset($_POST["comm"])) {
    $comm = $_POST["comm"];
} else {
    $comm = '';
}

if (isset($_POST["albums"])) {
    $albums = $_POST["albums"];
} else {
    $albums = '';
}

if (isset($_POST["note"])) {
    $note = $_POST["note"];
} else {
    $note = null;
}


if (isset($_POST["clic"])) {
    // Validation des champs
    if (empty($pseudo)) {
        $erreur .= "Veuillez indiquer votre pseudo<br>";
    }
    if ($albums < 1) {
        $erreur .= "Veuillez sélectionner un album valide<br>";
    }
    if ($note < 1 || $note > 5) {
        $erreur .= "Veuillez attribuer une note valide (1-5)<br>";
    }
    if (empty($comm) || $comm == "Votre commentaire...") {
        $erreur .= "Veuillez saisir un commentaire valide<br>";
    }

    if (empty($erreur)) {
        // Nettoyage des entrées
        $pseudo = addslashes(trim($pseudo));
        $comm = addslashes(trim($comm));
        $id_album = intval($albums);
        $note = intval($note);

        // Vérifie si l'utilisateur existe
        $verifie_utilisateur = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
        $utilisateur = lectureBDD($verifie_utilisateur);

        if (empty($utilisateur)) {
            $erreur .= "Pseudo inconnu. Veuillez vous inscrire d'abord.<br>";
        } else {
            $id_utilisateur = intval($utilisateur[0]['id_utilisateur']);

            // Vérifie si l'album existe
            $verifie_album = "SELECT nom FROM albums WHERE id_album = $id_album";
            $album = lectureBDD($verifie_album);

            if (empty($album)) {
                $erreur .= "Album sélectionné invalide<br>";
            } else {
                $nom_album = $album[0]['nom'];

                // Vérifie si l'utilisateur a déjà commenté cet album
                $verifie_existant = "SELECT id_avis FROM avis WHERE id_utilisateur = $id_utilisateur AND id_album = $id_album";
                $existant = lectureBDD($verifie_existant);

                if (!empty($existant)) {
                    $erreur .= "Vous avez déjà commenté cet album.<br>";
                } else {
                    // Insertion du commentaire avec la note
                    $ajout_commentaire = "INSERT INTO avis (id_utilisateur, id_album, note, commentaire, date_publication)
                      SELECT u.id_utilisateur, $id_album, $note, '$comm', NOW()
                      FROM utilisateur u
                      WHERE u.id_utilisateur = $id_utilisateur
                      AND u.pseudo = '$pseudo'";

                    if (ecritureBDD($ajout_commentaire)) {
                        $resultat = "<div class='resultat'>Merci pour votre note de $note/5 et votre commentaire sur $nom_album. <span>" . $pseudo . "</span> !</div>";
                        $pseudo = '';
                        $comm = '';
                        $albums = 0;
                        $note = 0;
                    } else {
                        $erreur .= "Erreur lors de l'enregistrement du commentaire<br>";
                    }
                }
            }
        }
    }
}



//Affichage des commentaires
$requete_comm = "SELECT u.pseudo, a.note, a.commentaire, a.date_publication, alb.nom as nom_album 
                FROM avis a 
                INNER JOIN utilisateur u ON u.id_utilisateur = a.id_utilisateur
                INNER JOIN albums alb ON alb.id_album = a.id_album
                ORDER BY a.date_publication DESC
                LIMIT 3";

$commentaires = lectureBDD($requete_comm);

// Stocke tout le HTML dans une variable
$affichage_comm = "<div class='div-comm'>";
$affichage_comm .= "<h4>Derniers commentaires</h4>";

if (!empty($commentaires)) {
    foreach ($commentaires as $comme) {
        $date_format = date("d/m/Y à H:i", strtotime($comme['date_publication']));
        $affichage_comm .= "<div class='commentaire'>";
        $affichage_comm .= "<p><strong>" . $comme['pseudo'] . "</strong> - Note: " . intval($comme['note']) . "/5</p>";
        $affichage_comm .= "<p>Album: " . $comme['nom_album'] . "</p>";
        $affichage_comm .= "<p>" . $comme['commentaire'] . "</p>";
        $affichage_comm .= "<p class='date-comm'>" . $date_format . "</p>";
        $affichage_comm .= "</div>";
    }
} else {
    $affichage_comm .= "<p>Aucun commentaire pour le moment</p>";
}

$affichage_comm .= "</div>";
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gorillaz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../Page/page.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="backopacity">

        <header>
            <div class="gorillazlog">
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
                            fill="white" d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
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


        <main id="top">
            <div class="main-flex">
                <div class="titre-filtre">
                    <?= $titre ?>
                    <div id="filtrage">
                        <button class="btn active" onclick="filterSelection('all')">Montrer tout</button>
                        <button class="btn" onclick="filterSelection('duree')">Par durée</button>
                        <button class="btn" onclick="filterSelection('annee')">Par année</button>

                    </div>
                </div>
                <!-- Menu de navigation -->
                <div class="menu"><?= $menu ?></div>

                <?= $contenu ?>
            </div>
            <?= $affichage_comm ?>
        </main>


        <footer>
            <div class="flex">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo:</label>
                        <input type="text" class="form-control" id="pseudo" placeholder="Entrez votre pseudo"
                            name="pseudo" value="<?= $pseudo ?>">
                    </div>
                    <div class="mb-3">
                        <label for="albums" class="form-label">Albums :</label>
                        <select name="albums" class="form-select" id="albums">
                            <option value="">-- Sélectionnez un album --</option>
                            <option value="1" <?= $albums == "1" ? "selected" : "" ?>>Gorillaz</option>
                            <option value="2" <?= $albums == "2" ? "selected" : "" ?>>Demon Days</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note :</label>
                        <div class="note">
                            <input type="radio" id="etoile1" name="note" value="1" <?= isset($_POST['note']) && $_POST['note'] == 1 ? 'checked' : '' ?>>
                            <label for="star1" title="1 étoile">1</label>
                            <input type="radio" id="etoile2" name="note" value="2" <?= isset($_POST['note']) && $_POST['note'] == 2 ? 'checked' : '' ?>>
                            <label for="star2" title="2 étoiles">2</label>
                            <input type="radio" id="etoile4" name="note" value="3" <?= isset($_POST['note']) && $_POST['note'] == 3 ? 'checked' : '' ?>>
                            <label for="star3" title="3 étoiles">3</label>
                            <input type="radio" id="etoile4" name="note" value="4" <?= isset($_POST['note']) && $_POST['note'] == 4 ? 'checked' : '' ?>>
                            <label for="star4" title="4 étoiles">4</label>
                            <input type="radio" id="etoile5" name="note" value="5" <?= isset($_POST['note']) && $_POST['note'] == 5 ? 'checked' : '' ?>>
                            <label for="star5" title="5 étoiles">5</label>
                        </div>
                        <div class="mb-3">
                            <label for="comm" class="form-label">Commentaire :</label>
                            <textarea name="comm" id="comm" class="form-control" style="resize: none;"><?php
                                                                                                        if (isset($_POST["comm"]))
                                                                                                            echo $_POST["comm"];
                                                                                                        else
                                                                                                            echo "Votre commentaire..."; ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="clic" value="ok">Envoyer</button>
                </form>
            </div>
            <?php
            if (!empty($erreur)) {
                echo "<div class='erreur'>$erreur</div>";
            } elseif (!empty($resultat)) {
                echo $resultat;
            }
            ?>

            <div class="cerclesvg">
                <a href="#top">
                    <svg class="white-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="31" height="31"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v13m0-13 4 4m-4-4-4 4" />
                    </svg>
                </a>
            </div>
            <!-- Effet d'animation en arrière-plan -->
            <div class="gorillaz-animation"></div>

            <div class="footer-content">
                <div class="footer-section about">
                    <a href="./index.php">
                        <img src="../img/gorillaz.logo_.white_.png" alt="Logo Gorillaz" class="footer-logo">
                    </a>
                    <p>Gorillaz est un groupe virtuel britannique formé en 1998 par le musicien Damon Albarn et l'artiste Jamie Hewlett.</p>
                    <div class="footer-socials">
                        <a href="https://www.facebook.com/Gorillaz" target="_blank" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="https://twitter.com/gorillaz" target="_blank" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/gorillaz" target="_blank" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/gorillaz" target="_blank" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-section links">
                    <h3>Liens Rapides</h3>
                    <ul class="footer-links">
                        <li><a href="./Page/page.php">Discographie</a></li>
                        <li><a href="https://www.gorillaz.com/" target="_blank">Site officiel</a></li>
                        <li><a href="#galerie">Galerie</a></li>
                        <li><a href="https://store.gorillaz.com/gb/" target="_blank">Boutique</a></li>
                    </ul>
                </div>

                <div class="footer-section contact">
                    <h3>Contactez-nous</h3>
                    <ul class="footer-links">
                        <li><a href="mailto:contact8@gorillaz-fan.com" target="_blank">contact8@gorillaz-fan.com</a></li>
                        <li><a href="https://privacy.wmg.com/wmi/privacy" target="_blank">Politique de confidentialité</a></li>
                        <li><a href="https://privacy.wmg.com/wmi/terms-of-use" target="_blank">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Gorillaz Site Fan | Tous droits réservés</p>
            </div>
        </footer>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous">
    </script>

    <script>
        window.addEventListener("scroll", function() {
            const header = document.querySelector("header");
            if (window.scrollY > 50) { // Se déclenche après 50px de scroll
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });
    </script>
</body>

</html>