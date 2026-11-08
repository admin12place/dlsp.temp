
<?php require_once "./scripts/functions.php";?>

<?php
session_start();

$send_message = "ENVOYEZ VOTRE MESSAGE";
$modal_open = false;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {

    // 1. Vérification CSRF
    $token = $_POST['csrf_token'] ?? '';

    if (
        !is_string($token) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $token)
    ) {
        http_response_code(403);
        exit('Formulaire invalide.');
    }

    // 2. Champ piège anti-robots
    $website = $_POST['website'] ?? '';

    if (!is_string($website) || trim($website) !== '') {
        // Ne pas révéler au robot qu'il a été détecté
        http_response_code(400);
        exit;
    }

    // 3. Récupération des données
    $nom     = trim($_POST['nom'] ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $mail    = trim($_POST['mail'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Vérifier que tous les champs sont des chaînes
    foreach ([$nom, $prenom, $mail, $phone, $message] as $value) {
        if (!is_string($value)) {
            http_response_code(400);
            exit('Données invalides.');
        }
    }

    // 4. Validation des champs
    if (
        $nom === '' ||
        $prenom === '' ||
        !filter_var($mail, FILTER_VALIDATE_EMAIL) ||
        strlen($mail) > 254 ||
        $phone === '' ||
        strlen($phone) > 40 ||
        $message === '' ||
        strlen($message) > 10000
    ) {
        http_response_code(400);
        exit('Veuillez vérifier les champs du formulaire.');
    }

    // Empêcher les injections dans les en-têtes de mail
    if (preg_match('/[\r\n]/', $mail)) {
        http_response_code(400);
        exit('Adresse e-mail invalide.');
    }

    // 5. Limitation simple par session :
    // maximum 3 envois en 10 minutes
    $now = time();
    $window = 600;

    if (
        !isset($_SESSION['contact_sends']) ||
        !is_array($_SESSION['contact_sends'])
    ) {
        $_SESSION['contact_sends'] = [];
    }

    $_SESSION['contact_sends'] = array_values(array_filter(
    $_SESSION['contact_sends'],
    function ($time) use ($now, $window) {
        return is_int($time) && $time > $now - $window;
        }
    ));

    if (count($_SESSION['contact_sends']) >= 3) {
        http_response_code(429);
        exit('Trop de tentatives. Veuillez réessayer plus tard.');
    }

    // Enregistrer la tentative avant l'envoi
    $_SESSION['contact_sends'][] = $now;

    // 6. Préparer le corps HTML en échappant les données
    $safeNom = htmlspecialchars(
        $nom, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'
    );
    $safePrenom = htmlspecialchars(
        $prenom, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'
    );
    $safeMail = htmlspecialchars(
        $mail, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'
    );
    $safePhone = htmlspecialchars(
        $phone, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'
    );
    $safeMessage = nl2br(htmlspecialchars(
        $message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'
    ));

    $bodyMail = "
        <strong>NOM :</strong> $safeNom $safePrenom<br>
        <strong>MAIL :</strong> $safeMail<br>
        <strong>TÉLÉPHONE :</strong> $safePhone<br>
        <strong>MESSAGE :</strong><br>$safeMessage
    ";

    // 7. Envoi avec PHPMailer
    $mailtosend = new PHPMailer(true);

    try {
        $mailtosend->isSMTP();
        $mailtosend->Host = 'vert.o2switch.net';
        $mailtosend->SMTPAuth = true;

        $mailtosend->Username = 'contact@deslitssurlaplace.fr';
        $mailtosend->Password = 'Deslitssurlaplace@7834';
        $mailtosend->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mailtosend->Port = 465;
        
        $mailtosend->Timeout = 10;
        $mailtosend->Timelimit = 20;

        $mailtosend->CharSet = 'UTF-8';
        $mailtosend->isHTML(true);

        $mailtosend->setFrom(
            'contact@deslitssurlaplace.fr',
            'deslitssurlaplace.fr'
        );

        $mailtosend->addAddress(
            'contact@deslitssurlaplace.fr'
        );
        $mailtosend->addCC(
            'lesgensdelaplace@orange.fr'
        );
        $mailtosend->addCC(
            '0641614344@deslitssurlaplace.fr'
        );

        $mailtosend->addReplyTo($mail, "$prenom $nom");

        $mailtosend->Subject = 'Nouveau message';
        $mailtosend->Body = $bodyMail;

        $mailtosend->send();

        echo 'Mail envoyé';

    } catch (\PHPMailer\PHPMailer\Exception $e) {
        error_log('Erreur PHPMailer : ' . $e->getMessage());
        http_response_code(500);
        echo "Une erreur est survenue lors de l'envoi.";
    }

    $_SESSION['message_sent'] = true;

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
/*fin de traitement du formulaire*/
    


if(isset($_SESSION['message_sent'])) {
    $send_message = "MESSAGE ENVOYÉ";
    $modal_open = true;
    unset($_SESSION['message_sent']);
    unset($_SESSION['csrf_token']);
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
        
        <link rel="preload" href="/images/20260624david0273.webp" as="image"><!--pré-chargement du header hero en bg-->
        
        <!--Meta SEO tags-->
        <meta name="title" content="Des lits sur la place | Hôtel à Hérépian | Chambres d'hôtes de charme à Hérépian | Hérault | Orb | Parc du Haut-Languedoc">
        <meta name="keywords" content="Chambres d'hôtes Hérépian, hôtel Hérépian, hotel herepian, hôtel Bédarieux, hôtel Lamalou, Des lits sur la place, Bed an Breakfast Hérépian, 
        hôtel Grand Orb, chambres de luxe, accueil vélo, hébergement">
        <meta name="description" content="Des lits sur la place, chambres d'hôtes de caractère à Hérépian, au coeur du Parc du Haut-Languedoc vous 
        accueille toute l'année. Appelez Marion au +33 (0)6 41 61 43 44">
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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TVGWYFS564"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-TVGWYFS564');
    </script>


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
                <span class="divite"><img src="./assets/1131825.png" alt="Image de séparation"/></span>
            </section>

            <section id="rooms">
                <h3 class="section-title">LES CHAMBRES</h3>
                <div class="main-text"><p class=""><?php echo $rooms_text;?></p></div><!--si besoin-->

                    <?php foreach ($tab_rooms as $room):{ 
                        if ($room['position'] === 'only-mobile') { ?>
                            <div class="room-contain <?= $room['position']; ?>">
                                <div class="article-mobile">
                                    <div class="img-room-contain">
                                        <?php foreach ($tab_rooms as $mobile_room):{ ?>
                                            <img class="img-room-mobile" src="<?= $mobile_room['img-src']; ?>" alt="<?= $mobile_room['img-alt']; ?>" />
                                        <?php } endforeach;?>
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
                                <span class="divite"><img src="./assets/1131825.png" alt="Image de séparation"/></span>
                            </div>

                        <?php } else { ?>
                            <div class="room-contain <?= $room['position']; ?>">
                                <div class="<?= $room['position']; ?>">
                                    <div class="img-room-contain">       
                                        <img class="img-room" src="<?= $room['img-src']; ?>" alt="<?= $room['img-alt']; ?>" />
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
                                    <span class="divite"><img src="./assets/1131825.png" alt="Image de séparation"/></span>
                            </div><?php }?>
                        </div>
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
                <span class="divite"><img src="./assets/1131825.png" alt="Image de séparation"/></span>
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
                <span class="divite"><img src="./assets/1131825.png" alt="Image de séparation"/></span>
            </section>

            <section id="biking">

                    <h3 class="section-title">L'ACCUEIL DES CYCLISTES</h3>

                <article class="biking-article">
                    <img class="slider-image" src="/images/slider/20241130133522T.webp" alt="Randovelo34.fr - Les Bardenas reales"/>
                    <p class="main-text"><?php echo $biking_text;?></p>
                </article>
                <span class="divite"><img src="./assets/1131825.png" alt="Image de séparation"/></span>
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
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Carte Google Maps centrée sur Hérépian">
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

                <span class="widgets-mobile only-mobile">
                    <?php include './templates/googleLink.php'; ?>
                </span>
                
                <div class="contact-form"><?php include './templates/modalContact.php'; ?></div>
                
            </section>
        </main>

        <footer>
            <?php require 'structure/footer.php'; ?>
        </footer>
    
    <script src="./scripts/script.js"></script>

    </body>
</html>
