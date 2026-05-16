<!DOCTYPE html>
<html lang="fr">

    <?php require_once './scripts/functions.php';?><!--INCLUSION DU FICHIER DE FONCTIONS PHP-->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Des lits sur la place - Chambres d'hôtes dans l'Herault</title>
        <link rel="stylesheet" href="./css/constantes.css">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
        <!--Meta SEO tags-->
        <meta name="title" content="Des lits sur la place | Chambres d'hôtes de charme à Hérépian | Hérault | Orb | Parc du Haut-Languedoc">
        <meta name="keywords" content="Chambres d'hôtes Hérépian, hôtel classé Hérault, Des lits sur la place, Bed an Breakfast Hérépian, 
        hôtel Grand Orb, chambres de luxe, accueil vélo Hérault">
        <meta name="description" content="Des lits sur la place, chambres d'hôtes de caractère à Hérépian, au coeur du Parc du Haut-Languedoc vous 
        accueille toute l'année. En couple ou en famille, pour le travail ou pour les loisirs, venez profiter du calme et du charme d'un
        village typiquement méridional.">
        <meta name="author" content="Des lits sur la place - Marion Deloulay Kleitz et Thierry Deloulay">
        <meta name="robots" content="index, follow">

        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "LocalBusiness",
                "name": "Des lits sur la place",
                "address": {
                "@type": "12 place de la croix",
                "addressLocality": "Hérépian",
                "postalCode": "34600",
                "addressCountry": "FR"
                }
            }
        </script>

    </head>

    <body id="home">
        <header class="container-logo-menu">
            <div class="logo-title">
                <a href="#"><img class="logo" src="./images/logo-dlsp-alpha.webp" alt="Logo Des lits sur la place"/></a>
                <div class="titles">
                    <!--<h2>DES LITS SUR LA PLACE</h2>-->
                    <h1>Chambres d'hôtes en Occitanie</h1>
                </div>
                <article class="details">
                    <div class="phone header-phone">
                        <img class="icons" src="./assets/call_icon.png" alt="Téléphone"/>
                        <span class="phone-number">06 41 61 43 44</span>
                    </div>
                    <div class="adresse">
                        <span>12 place de la croix<br/>34600 HÉRÉPIAN</span>
                    </div>
                </articles>
            </div>

            <nav class="main-menu">
                <ul class="menu-items">
                    <li class="display-laptop"><a href="#home"><img class="icons" src="./assets/home_icon.png" alt="Page d'accueil" title="Page d'accueil"/></a></li>
                    <li class="display-mobile"><a href="#home">Accueil</a></li>
                    <li><a href="#rooms" title="Découvrez nos chambres">Les chambres</a></li>
                    <li><a href="#extras" title="Dans votre chambre">Les services</a></li>
                    <li><a href="#biking" title="Bienvenue aux &#10; cyclistes">L'accueil vélo</a></li>
                    <li><a href="#discovering" title="A découvrir">La région</a></li>
                    <li><a href="#join-us" title="Réserver, nous écrire">Réservation Contact</a></li>
                    <li class="display-laptop"><a href="#join-us"><img class="icons" src="./assets/map_icon.png" alt="Nous trouver" title="Nous trouver"/></a></li>
                    <li class="display-mobile"><a href="#join-us">Nous trouver</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section id="presentation">
                <div class="banner">
                    <h2 class="section-title">Des lits sur la place</h2>
                    <h3 class="section-undertitle">au coeur du parc du Haut-Languedoc</h3>
                </div>
                <div class="main-text">
                    <p><?php echo $main_text;?></p>
                </div>
                <span class="divite"><img src="./assets/1131825.png"/></span>
            </section>

            <section id="rooms">
                <h3 class="section-title">LES CHAMBRES</h3>

                    <?php foreach ($tab_rooms as $room):{ ?>
                        <div class="<?= $room['position'] ?>">
                            <div class="img-room-contain">
                                <img class="img-room" src="<?= $room['img-src'] ?>" alt="<?= $room['img-alt'] ?>" />
                            </div>
                            <div class="text-room-contain">
                                <h4><?= $room['room-title'] ?></h4>
                                <ul>
                                    <li><?= $room['room-surface'] ?></li>
                                    <li><?= $room['room-bed'] ?></li>
                                    <li><?= $room['room-bath'] ?></li>
                                    <li><?= $room['room-clim'] ?></li>
                                    <li><?= $room['room-xtras'] ?></li>
                                </ul>
                                <span class="room-text"><?= $room['room-text'] ?></span>
                            </div>
                        </div>
                    <span class="divite"><img src="./assets/1131825.png"/></span>
                    <?php } endforeach; ?>
            </section>

            <section id="extras">
                <h3 class="section-title">LES SERVICES</h3>
                <div class="articles">
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/wifi_icon.webp" alt="Wifi" title="Wifi gratuit"/>
                        <h4>Wifi</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/tv_icon.webp" alt="Télévision" title="Télévision dans toutes les chambres"/>
                        <h4>télévision</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/clim_icon.webp" alt="Climatisation" title="Chambres climatisées"/>
                        <h4>Climatisation</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/pdj_icon.webp" alt="Petit déjeuner" title="Petit déjeuner continental fait maison"/>
                        <h4>Petit déjeuner compris</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/parking_icon.png" alt="Parking gratuit" title="Parking gratuit à 150 mètres"/>
                        <h4>Parking</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/resto_icon.png" alt="Restaurant" title="Restaurant l'Ocre Rouge"/>
                        <h4>Restaurant sur place</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/kitch_icon.webp" alt="Kitchenette à disposition" title="Kitchenette à disposition"/>
                        <h4>Kitchenette</h4>
                    </article>
                    <article class="xtra-card">
                        <img class="xtra-icon" src="./assets/terrasse_icon.webp" alt="Terrasse partagée" title="Terrasse partagée"/>
                        <h4>Terrasse</h4>
                    </article>
                </div>
            </section>
                
            <section id="discovering">
                <h3 class="section-title">LA RÉGION</h3>
                <div class="main-text">
                    <p><?php echo $region_text;?></p>
                </div>
                <div id="slider">
                    <img class="slider-image" src="/images/slider/fleurs3028.webp" alt="Découvrir le Parc"/>
                    <div class="arrows">
                        <img class="arrow arrow_left"  src="./assets/arrow_left.png" alt="Image précédente"/>
			            <img class="arrow arrow_right"  src="./assets/arrow_right.png" alt="Image suivante"/>
                    </div>
                    <p id="tag-line">Découvrir le Parc du Haut-Languedoc</p>
                </div>
            </section>

            <section id="join-us">
                <h3 class="section-title">NOUS JOINDRE, NOUS TROUVER</h3>
                    <div class="">
                    
                    </div>
            </section>
        </main>

        <footer>
        <span>&#xA9; des lits sur la place 2026</span>
        </footer>
    
    <script src="./scripts/script.js"></script>
    </body>
</html>
