<?php
require "fonction_form.php";

// TRAITEMENT DU FORMULAIRE
// Initialisation des chaines de caractères
$resultat = "";
$erreur = "";

// Initialisation des variables
if (!empty($_POST["nom"]))
    $nom = $_POST["nom"];
else
    $nom = '';

if (!empty($_POST["prenom"]))
    $prenom = $_POST["prenom"];
else
    $prenom = '';

if (!empty($_POST["pseudo"]))
    $pseudo = $_POST["pseudo"];
else
    $pseudo = '';

if (!empty($_POST["email"]))
    $email = $_POST["email"];
else
    $email = '';


// Le résultat du traitement est enregistré dans $resultat
if (isset($_POST["clic"]))    // Si le formulaire a été validé
{
    // Traitement de la civilité
    if (empty($nom))
        $erreur .= "Veuillez indiquer votre nom<br>";

    // Traitement de la désignation
    if (empty($prenom))
        $erreur .= "Veuillez indiquer votre prénom<br>";

    if (empty($pseudo))
        $erreur .= "Veuillez indiquer votre pseudo<br>";

    // Traitement du prix
    if (!empty($_POST["email"])) {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $erreur .= "L'adresse email n'est pas valide<br>";
        }
    } else {
        $erreur .= "L'adresse email est obligatoire<br>";
    }

    if (empty($erreur)) {
        // Vérifier si le pseudo existe déjà
        $verif_incr = "SELECT COUNT(*) FROM utilisateur WHERE pseudo = '$pseudo' OR email = '$email'";
        $verif_incr = lectureBDD($verif_incr);

        if ($verif_incr[0]['COUNT(*)'] > 0) {
            $erreur .= "Ce pseudo ou cet email est déjà utilisé.<br>Veuillez en choisir un autre.<br>";
        } else {
            // Si le pseudo et l'email sont uniques, procéder à l'insertion
            $requete = "INSERT INTO utilisateur (nom, prenom, pseudo, email) VALUES ('$nom', '$prenom', '$pseudo', '$email')";
            $nb_ecriture = ecritureBDD($requete);

            if ($nb_ecriture == 1) {
                $resultat = "Bienvenue <span>$pseudo</span>, vous êtes maintenant enregistré sur notre site.";
            } else {
                $erreur .= "Échec lors de l'enregistrement de votre compte.";
            }
        }
    }
} else
    $resultat = "Veuillez compléter le formulaire";

//var_dump($_POST);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gorillaz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/signup.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <div class="gorillazlog">
            <a href="index.php">
                <img src="./img/gorillaz.logo_.white_.png" alt="Logo Gorillaz">
            </a>
        </div>
        <div class="flexnav">
            <a href="page.php" class="discographie nav">DISCOGRAPHIE</a>
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
            <a href="signup.php" class="a-inscr">SIGN UP
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                    <circle cx="12" cy="10" r="3" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </a>
            <div class="dropdown-content">
                <a href="signup.php">S'inscrir</a>
                <a href="connexion.php">Se connecter</a>
            </div>
        </div>
    </header>



    <div class="flex">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="mb-3 mt-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom" name="nom" value="<?= $nom ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom:</label>
                <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom" name="prenom" value="<?= $prenom ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Pseudo:</label>
                <input type="text" class="form-control" id="pseudo" placeholder="Entrez votre pseudo" name="pseudo" value="<?= $pseudo ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="michel@notmail.com" name="email" value="<?= $email ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="clic" value="ok">S'inscrir</button>
        </form>

    </div>


    <?php
    if (!empty($erreur)): ?>
        <div class="erreur">
            <?= $erreur ?>
            <div class="message-croix" aria-label="Fermer" role="button">
                <div class="croix">
                    <div class="barre-diag1"></div>
                    <div class="barre-diag2"></div>
                </div>
            </div>
        </div>
    <?php elseif (!empty($resultat)): ?>
        <div class="resultat">
            <?= $resultat ?>
            <div class="message-croix" aria-label="Fermer" role="button">
                <div class="croix">
                    <div class="barre-diag1"></div>
                    <div class="barre-diag2"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <footer>
        <div class="footer-content">
            <div class="footer-section about">
                <a href="index.php">
                    <img src="./img/gorillaz.logo_.white_.png" alt="Logo Gorillaz" class="footer-logo">
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
                    <li><a href="page.php">Discographie</a></li>
                    <li><a href="https://www.gorillaz.com/" target="_blank">Site officiel</a></li>
                    <li><a href="index.php">Galerie</a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous">
    </script>

    <script> //animation bouton fermeture message formulaire
        document.querySelectorAll('.message-croix').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });
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

    <script>
        // Empêche la resoumission à l'actualisation
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>