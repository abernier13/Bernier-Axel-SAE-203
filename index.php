<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gorillaz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="backopacity">
        <!-- Éléments de la vidéo -->
        <div class="backvideo">
            <div class="logostart">
                <a href="javascript:void(0);" onclick="videoduration()" id="logstart">
                    <!--javascript:void(0); pour éviter le rechargement de la page ou une navigation.-->
                    <img src="img/gorillaz.logo_.white_.png" alt="logo Gorillaz">
                </a>
            </div>
            <div id="player-container">
                <video id="player" width="100%" height="100%">
                    <source src="video/Gorillaz - 19-2000 (Official Video).mp4" type="video/mp4">
                </video>
            </div>
        </div>


        <!-- Contenu principal (sera visible après la vidéo) -->

        <header>
            <div class="gorillazlog">
                <a href="./index.php">
                    <img src="./img/gorillaz.logo_.white_.png" alt="Logo Gorillaz">
                </a>
            </div>
            <div class="flexnav">
                <a href="./Page/page.php" class="discographie nav">DISCOGRAPHIE</a>
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
                <a href="./Page/Formulaire/signup.php" class="a-inscr">SIGN UP
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                        <circle cx="12" cy="10" r="3" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                </a>
                <div class="dropdown-content">
                    <a href="./Page/Formulaire/signup.php">S'inscrire</a>
                    <a href="./Page/Formulaire/connexion.php">Se connecter</a>
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

        <div class="containinfo">
            <h3>Albums</h3>
            <div class="info">
                <div class="contain">
                    <img src="./img/albums/0724353448806.jpg" alt="">
                </div>
                <div class="contain">
                    <img src="./img/albums/0x1900-000000-80-0-0.jpg" alt="">
                </div>
                <div class="contain">
                    <img src="./img/albums/550x554.jpg" alt="">
                </div>
                <div class="contain">
                    <img src="./img/albums/71M8yXz6o7L._UF1000,1000_QL80_.jpg" alt="">
                </div>
                <div class="contain">
                    <img src="./img/albums/GorillazCrackerIsland.jpg" alt="">
                </div>
                <div class="contain">
                    <img src="./img/albums/humanz.webp" alt="">
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous">
    </script>
    <script src="js/videostart.js"></script>
    <script src="js/session.js"></script>
    <script src="js/perso.js"></script>

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