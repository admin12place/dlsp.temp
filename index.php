
<?php require_once "./scripts/functions.php";?>

<?php
session_start();
$send_message = "ENVOYEZ VOTRE MESSAGE";
$modal_open = false;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


if(isset($_POST['nom'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    //envoi du message via phpmailer
    $bodyMail = "NOM : $nom $prenom<br>
                MAIL : $mail<br>
                TELEPHONE : $phone<br>
                MESSAGE : $message";

    $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.texio.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'smtp@deslitssurlaplace.fr';
            $mail->Password = 'hktdwfrt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            $mail->isHTML(true);
            $mail->setFrom('contact@deslitssurlaplace.fr', 'deslitssurlaplace.fr');
            $mail->addReplyTo = $mail;
            $mail->addAddress('contact@deslitssurlaplace.fr');
            $mail->addCC('lesgensdelaplace@orange.fr');
            $mail->Subject = 'Nouveau message de test';
            $mail->Body = $bodyMail;
            $mail->send();
            echo 'Mail envoyé';
        }

        catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
    //fin de routine

    $_SESSION['message_sent'] = true;

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if(isset($_SESSION['message_sent'])) {
    $send_message = "MESSAGE ENVOYÉ";
    $modal_open = true;
    unset($_SESSION['message_sent']);
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Des lits sur la place - Chambres d'hôtes dans l'Herault</title>
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/parts.css">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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

    <body id="home" data-modal-open="<?php echo $modal_open ? 'true' : 'false'; ?>">
        <header id="header-type" class="container-logo-menu">
            <?php require 'structure/header.php'; ?>
        </header>

        <main>
            <section id="presentation">
                <div class="banner">
                    <h2 class="section-title">Des lits sur la place</h2>
                    <h1>Chambres d'hôtes en Occitanie</h1>
                    <h3 class="section-undertitle">au coeur du parc du Haut-Languedoc</h3>
                </div>
                <div class="main-text">
                    <p><?php echo $main_text1;?></p><p><?php echo $main_text2;?></p>
                </div>
                <span class="divite"><img src="./assets/1131825.png"/></span>
            </section>

            <section id="rooms">
                <h3 class="section-title">LES CHAMBRES</h3>
                <div class="main-text"><p class=""><?php echo $rooms_text;?></p></div><!--si besoin-->

                    <?php foreach ($tab_rooms as $room):{ ?>
                    <div class="room-contain <?= $room['position'] ?>">
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
                                <p class="room-icons">
                                    <?php foreach ($room['icones'] as $icone): ?>
                                        <img class="mini-icons" src="./assets/<?= $icone; ?>" alt="Icônes de services" />
                                    <?php endforeach;?>
                                </p>

                            </div>
                        </div>
                        <span class="divite"><img src="./assets/1131825.png"/></span>
                    </div>
                    
                    <?php } endforeach; ?>
            </section>

            <section id="extras">
                <h3 class="section-title">LES SERVICES</h3>
                    <div class="main-text"><p class=""><?php echo $extras_text;?></p></div><!--si besoin-->
                
                <div class="articles-wrapper">
                    <div class="articles">

                        <?php $index_xtras = 0;
                        while ($index_xtras < 2) {//on boucle 2 fois
                        foreach ($tab_xtras as $xtra):{ ?>
                            <article class="xtra-card">
                                <img class="xtra-icon" src="<?= $xtra['xtras_src']; ?>" alt="<?= $xtra['xtras_alt']; ?>" title="<?= $xtra['xtras_title']; ?>" />
                                <h4><?= $xtra['xtras_h4']; ?></h4>
                            </article>
                        <?php } endforeach; $index_xtras++; };?>

                    </div>
                </div>

                <div class="main-text">
                    <h4 class="center text-subtitle">Et pour une expérience complète...</h4>
                    <p><?php echo $xtra_text;?></p>
                </div>
                <span class="divite"><img src="./assets/1131825.png"/></span>
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
                        <span id="tag-line">Découvrir le Parc du Haut-Languedoc</span>
			            <img class="arrow arrow_right"  src="./assets/arrow_right.png" alt="Image suivante"/>
                    </div>
                </div>
                <span class="divite"><img src="./assets/1131825.png"/></span>
            </section>

            <section id="biking">

                    <h3 class="section-title">L'ACCUEIL DES CYCLISTES</h3>

                <article class="biking-article">
                    <img class="slider-image" src="/images/slider/20241130133522T.webp" alt="Randovelo34.fr - Les Bardenas realesS"/>
                    <p class="main-text"><?php echo $biking_text;?></p>
                </article>
                <span class="divite"><img src="./assets/1131825.png"/></span>
            </section>

            <section id="join-us">
                <h3 class="section-title">NOUS JOINDRE, NOUS TROUVER</h3>
                <div class="main-text"><p class="cta-phone">APPELEZ-NOUS AU <span class="cta-nowrap">06 41 61 43 44</span></p></div>
                
                <div class="contact">
                    <a href="tel:+33641614344"><article class="contact-card">
                        <img class="contact-icon" src="./assets/phone.svg" alt="Téléphone" title="+33 (0)6 41 61 43 44"/>
                        <h4>Appelez-nous</h4>
                    </article></a>

                    <a href="#join-us" id="open-contact-modal"><article class="contact-card">
                        <img class="contact-icon" src="./assets/arobase.svg" alt="Climatisation" title="contact@deslitssurlaplace.fr"/>
                        <h4>Écrivez-nous</h4>
                    </article></a>

                    <article class="contact-card">
                        <img class="contact-icon" src="./assets/letter.svg" alt="Adresse" title="Adresse postale"/>
                        <h4>Des lits sur la place
                        <p class="adresse">12 place de la croix<br/>34600 HÉRÉPIAN</p></h4>
                    </article>
                </div>
                
                <div class="place-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2889.6698214727203!2d3.114027476857337!3d43.59259327110507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b177f520af9c1b%3A0xf5a0f98b5a9f60cd!2sDes%20lits%20sur%20la%20place!5e0!3m2!1sfr!2sfr!4v1779022750244!5m2!1sfr!2sfr" 
                        allowfullscreen="" loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="map-text">
                        <li>Dépose minute devant le bâtiment</li>
                        <li>Parking gratuit à 150 m</li>
                        <li>Garage sécurisé pour les vélos</li>
                        <li class="evidence">Arrivée à partir de 16 heures</li>
                        <li>Voie verte PassaPaïs à 200 m</li>
                        <li>Gare de Bédarieux à 3 km</li>
                    </div>
                </div>
                
                <div class="contact-form"><?php include './templates/modalContact.php'; ?></div>
                
            </section>
        </main>

        <footer>
            <?php require 'structure/footer.php'; ?>
        </footer>
    
    <script src="./scripts/script.js"></script>

    </body>
</html>
