<?php
$menu = "<a class='lien' href='controleur.php?liste=albums'>Albums</a>
<a class='lien' href='controleur.php?liste=musiques'>Musiques</a>";

if (!isset($liste)) $liste = 'albums';
if (!isset($table)) $table = [];

$titre = "";
$contenu = "";

if ($liste == "albums") {
    $titre = "<div class='titrealb'><h3>Liste des albums</h3></div>";
    $contenu = "<div class='albums-container'>";

    if (!empty($table)) {
        foreach ($table as $album) {
            $contenu .= "
            <div class='album-card'>
                <img src='{$album['cover_image']}' alt='{$album['nom']}'>
                <h4>{$album['nom']}</h4>
                <p>Année: {$album['annee']}</p>
                <p>Description: {$album['description']}</p>
                <a href='{$album['spotify_url']}' class='bouton' target='_blank'>Écouter</a>
                <a href='?liste=musiques&album={$album['id_album']}' class='bouton'>Voir les titres</a>
            </div>";
        }
    } else {
        $contenu .= "<p>Aucun album trouvé</p>";
    }
    $contenu .= "</div>";
} elseif ($liste == "musiques") {
    $titre = "<h3>Liste des titres</h3>";
    $idAlbum = isset($_GET['album']) ? intval($_GET['album']) : 0;

    if ($idAlbum > 0) {
        try {
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $bdd = new PDO('mysql:host=localhost;dbname=gorillaz_song', 'root', 'root', $options);

            // Requête pour obtenir les infos de l'album 
            $reqAlbum = $bdd->query("SELECT nom, spotify_url FROM albums WHERE id_album = " . intval($idAlbum));
            $albumInfo = $reqAlbum->fetch(PDO::FETCH_ASSOC);

            // Requête pour récupérer les musiques de l'album 
            $reqMusiques = $bdd->query("SELECT titre, lien_drive, spotify_url FROM musiques WHERE id_album = " . intval($idAlbum));
            $table = $reqMusiques->fetchAll(PDO::FETCH_ASSOC);

            $contenu = "<div class='song'>";
            $contenu .= "<div class='div-album'>";
            $contenu .= "<a href='" . $albumInfo['spotify_url'] . "' class='link-album' target='_blank'>" . $albumInfo['nom'] . "</a>";
            $contenu .= "</div>";

            if (!empty($table)) {
                foreach ($table as $musique) {
                    $audioSrc = convertirLienDrive($musique['lien_drive']); //conversion du lien
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
        } catch (Exception $e) {
            $contenu = "<p>Erreur de connexion à la base de données</p>";
        }
    } else {
        $contenu = "<div class='song'>";
        if (!empty($table)) {
            foreach ($table as $musique) {
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
            $contenu .= "<p>Aucun titre trouvé</p>";
        }
        $contenu .= "</div>";
    }
}




//Le formulaire
require "../Page/Formulaire/fonction_form.php";

$resultat = "";
$erreur = "";
$pseudo = $_POST["pseudo"] ?? '';
$comm = $_POST["comm"] ?? '';
$albums = $_POST["albums"] ?? '';
$note = $_POST["note"] ?? null;

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
        $pseudo_clean = $pseudo;
        $comm_clean = $comm;
        $id_album = intval($albums);
        $note_clean = intval($note);

        // Vérifie si l'utilisateur existe
        $verifie_utilisateur = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = '$pseudo_clean'";
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
                    $ajout_commentaire = "INSERT INTO avis (id_utilisateur, id_album, pseudo, note, commentaire, date_publication) 
                                  VALUES ($id_utilisateur, $id_album, '$pseudo_clean', $note_clean, '$comm_clean', NOW())";

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


        <main>
            <div class="main-flex">
                <?= $titre ?>
                <!-- Menu de navigation -->
                <div class="menu"><?= $menu ?></div>

                <?= $contenu ?>
            </div>
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