<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gorillaz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="backopacity">
        <!-- Éléments de la vidéo -->
        <div class="backvideo">
            <div class="logostart">
                <a href="javascript:void(0);" onclick="videoduration()" id="logstart">
                    <!--javascript:void(0); pour éviter le rechargement de la page-->
                    <img src="img/gorillaz.logo_.white_.png" alt="logo Gorillaz">
                </a>
            </div>
            <div id="player-container">
                <video id="player" width="100%" height="100%" preload="auto">
                    <source src="video/Gorillaz - 19-2000 (Official Video).mp4" type="video/mp4">
                </video>
            </div>
        </div>


        <!-- Contenu principal (sera visible après la vidéo) -->

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
                    <a href="signup.php">S'inscrire</a>
                    <a href="connexion.php">Se connecter</a>
                </div>
            </div>
        </header>


        <main>
            <h1>Membres de Gorillaz</h1>

            <div class="member-container">
                <div class="arrow" id="prev">❮</div>

                <div class="member-card">
                    <div class="member-content" id="2d">
                        <img src="./img/Personnage/2D.webp" alt="2-D">
                        <h2>2-D</h2>
                        <p>Le chanteur et claviériste au regard vide.</p>
                    </div>

                    <div class="member-content hidden" id="murdoc">
                        <img src="./img/Personnage/Murdoc Nicolas.webp" alt="Murdoc">
                        <h2>Murdoc Niccals</h2>
                        <p>Le bassiste diabolique et leader autoproclamé.</p>
                    </div>

                    <div class="member-content hidden" id="noodle">
                        <img src="./img/Personnage/Noodle.jpg" alt="Noodle">
                        <h2>Noodle</h2>
                        <p>La guitariste mystérieuse et talentueuse.</p>
                    </div>

                    <div class="member-content hidden" id="russel">
                        <img src="./img/Personnage/Russel Hobbs.webp" alt="Russel">
                        <h2>Russel Hobbs</h2>
                        <p>Le batteur imposant et spirituel.</p>
                    </div>
                    <div class="member-content hidden" id="damon">
                        <img src="./img/2020_Damon_Albarn.webp" alt="Damon">
                        <h2>Damon Albarn</h2>
                        <p>Le créateur du groupe</p>
                    </div>
                </div>

                <div class="arrow" id="next">❯</div>
            </div>

            <div class="member-tabs">
                <div class="member-tab active" data-target="2d">2-D</div>
                <div class="member-tab" data-target="murdoc">Murdoc</div>
                <div class="member-tab" data-target="noodle">Noodle</div>
                <div class="member-tab" data-target="russel">Russel</div>
                <div class="member-tab" data-target="damon">Damon</div>
            </div>
        </main>
        <br>
        <br>

        <div class="containinfo" id="galerie">
            <h3>Albums</h3>
            <div class="filtre">
                <h4>Filtrer par année</h4>
                <select id="filtre-annee">
                    <option value="">Toutes</option>
                    <option value="a2000">2000–2010</option>
                    <option value="a2011">2011–2023</option>
                </select>

                <h4>Filtrer par style</h4>
                <select id="filtre-style">
                    <option value="">Tous</option>
                    <option value="rap">Rap alternatif</option>
                    <option value="rock">Rock alternatif</option>
                    <option value="electro">Electro-pop</option>
                    <option value="experimental">Expérimental</option>
                    <option value="hip-hop">Hip-hop</option>
                    <option value="funk">Funk</option>
                    <option value="eclectique">Eclectique</option>
                    <option value="dream">Dream-pop</option>
                </select>

                <h4>Filtrer par ambiance</h4>
                <select id="filtre-ambiance">
                    <option value="">Toutes</option>
                    <option value="sombre">Sombre</option>
                    <option value="apocalyptique">Apocalyptique</option>
                    <option value="futuriste">Futuriste</option>
                    <option value="introspective">Introspective</option>
                    <option value="chaotique">Chaotique</option>               
                    <option value="serie">Série musicale</option>               
                    <option value="mystique">Mystique</option>               
                </select>
            </div>
            <div class="info">
                <div class="contain a2000 rap sombre">
                    <img src="./img/albums/0724353448806.jpg" alt="Gorillaz">
                </div>
                <div class="contain a2000 electro futuriste">
                    <img src="./img/albums/0x1900-000000-80-0-0.jpg" alt="Plastic Beach">
                </div>
                <div class="contain a2011 funk introspective">
                    <img src="./img/albums/550x554.jpg" alt="The Now Now">
                </div>
                <div class="contain a2000 rock apocalyptique">
                    <img src="./img/albums/71M8yXz6o7L._UF1000,1000_QL80_.jpg" alt="Demon Days">
                </div>
                <div class="contain a2011 dream mystique">
                    <img src="./img/albums/GorillazCrackerIsland.jpg" alt="Cracker Island">
                </div>
                <div class="contain a2011 hip-hop chaotique">
                    <img src="./img/albums/humanz.webp" alt="Humanz">
                </div>
                <div class="contain a2011 experimental introspective">
                    <img src="./img/albums/TheFallTextless.webp" alt="The Fall">
                </div>
                <div class="contain a2000 rap serie">
                    <img src="./img/albums/ITunes_Session_cover.webp" alt="iTunes Session">
                </div>
                <div class="contain a2011 eclectique serie">
                    <img src="./img/albums/81-19WGwkzL._UF894,1000_QL80_.jpg" alt="Song Machine">
                </div>
            </div>
        </div>



        <footer>
            <!-- Effet d'animation en arrière-plan -->
            <div class="gorillaz-animation"></div>

            <div class="footer-content">
                <div class="footer-section about">
                    <a href="./index.php">
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
    <script src="js/videostart.js"></script>
    <script src="js/session.js"></script>
    <script src="js/perso.js"></script>
    <script src="js/filtre.js"></script>

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