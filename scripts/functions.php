<?php

$tab_rooms = [
    'mobile-rooms' => [
        'position' => 'only-mobile',
        'img-alt' => 'Des lits sur la place, nos chambres',
        'img-src' => './images/WP_359.jpg',
        'room-title' => '',
        'room-surface' => ' De 20 à 31 m2',
        'room-bed' => 'De 2 à 4 couchages, lits séparables',
        'room-bath' => 'Salle de bain privative,douche, wc, lavabo',
        'room-clim' => 'Climatisation',
        'room-xtras' => 'Télévision & Wifi gratuits',
        'room-text' => 'De 82 à 97 € la nuit pour 2 personnes, petit déjeuner compris.'
    ],

    'celadon' => [
        'position' => 'impair-room',
        'img-alt' => 'Des lits sur la place, chambre Céladon',
        'img-src' => './images/WP_359.jpg',
        'room-title' => 'Chambre Céladon',
        'room-surface' => '20 m2',
        'room-bed' => 'Lit double 180 X 200',
        'room-bath' => 'Salle de bain privative,douche, wc, lavabo',
        'room-clim' => 'Climatisation naturelle',
        'room-xtras' => 'Télévision & Wifi gratuits',
        'room-text' => '82€ la nuit pour 2 personnes, petit déjeuner compris.'
    ],

    'sienne-alizarine' => [
        'position' => 'pair-room',
        'img-alt' => 'Des lits sur la place, chambre Sienne',
        'img-src' => './images/WP_359.jpg',
        'room-title' => 'Chambre Sienne,<br/>chambre Alizarine',
        'room-surface' => 'De 21 à 24 m2 (2 personnes)',
        'room-bed' => 'Lit double 180 X 200, séparable',
        'room-bath' => 'Salle de bain privative,douche, wc, lavabo',
        'room-clim' => 'Climatisation',
        'room-xtras' => 'Télévision & Wifi gratuits',
        'room-text' => '89€ la nuit pour 2 personnes, petit déjeuner compris.'
    ],

    'ombre' => [
        'position' => 'impair-room',
        'img-alt' => 'Des lits sur la place, chambre Terre d\'Ombre',
        'img-src' => './images/WP_1051.jpg',
        'room-title' => 'Chambre Terre d\'Ombre',
        'room-surface' => '30 m2 (2 à 4 personnes)',
        'room-bed' => 'Lit double 180 X 200, séparable,<br/>lit double 160 X200 en mezzanine',
        'room-bath' => 'Salle de bain privative,douche, wc, lavabo',
        'room-clim' => 'Climatisation',
        'room-xtras' => 'Télévision & Wifi gratuits',
        'room-text' => '97€ la nuit pour 2 personnes, petit déjeuner compris.'
    ],

    'pouzolle' => [
        'position' => 'pair-room',
        'img-alt' => 'Des lits sur la place, chambre Terre de Pouzolle',
        'img-src' => './images/WP_359.jpg',
        'room-title' => 'Chambre Terre de Pouzolle',
        'room-surface' => '31 m2 (2 à 4 personnes)',
        'room-bed' => 'Lit double 180 X 200, séparable, 2 lits single',
        'room-bath' => 'Salle de bain privative,douche, wc, lavabo',
        'room-clim' => 'Climatisation',
        'room-xtras' => 'Télévision & Wifi gratuits',
        'room-text' => '97€ la nuit pour 2 personnes, petit déjeuner compris.'
    ],
];

$tab_xtras = [
    'wifi' => [
        'xtras_src' => './assets/wifi_icon.webp',
        'xtras_alt' => 'Wifi',
        'xtras_title' => 'Wifi gratuit',
        'xtras_h4' => 'Wifi',
    ],

    'tv' => [
        'xtras_src' => './assets/tv_icon.webp',
        'xtras_alt' => 'Télévision',
        'xtras_title' => 'Télévision dans toutes les chambres',
        'xtras_h4' => 'Télévision',
    ],

    'clim' => [
        'xtras_src' => './assets/clim_icon.webp',
        'xtras_alt' => 'Climatisation',
        'xtras_title' => 'Chambres climatisées',
        'xtras_h4' => 'Climatisation',
    ],

    'pdj' => [
        'xtras_src' => './assets/pdj_icon.webp',
        'xtras_alt' => 'Petit déjeuner',
        'xtras_title' => 'Petit déjeuner continental fait maison',
        'xtras_h4' => 'Petit déjeuner compris',
    ],

    'resto' => [
        'xtras_src' => './assets/resto_icon.png',
        'xtras_alt' => 'Restaurant',
        'xtras_title' => 'Restaurant l\'Ocre Rouge',
        'xtras_h4' => 'Restaurant sur place',
    ],

    'parking' => [
        'xtras_src' => './assets/parking_icon.png',
        'xtras_alt' => 'Parking gratuit',
        'xtras_title' => 'Parking gratuit à 150 mètres',
        'xtras_h4' => 'Parking',
    ],

    'cuisine' => [
        'xtras_src' => './assets/kitch_icon.webp',
        'xtras_alt' => 'Kitchenette à disposition',
        'xtras_title' => 'Kitchenette à disposition sur la terrasse',
        'xtras_h4' => 'Kitchenette',
    ],

    'terrasse' => [
        'xtras_src' => './assets/terrasse_icon.webp',
        'xtras_alt' => 'Terrasse partagée',
        'xtras_title' => 'Terrasse partagée en autonomie',
        'xtras_h4' => 'Terrasse',
    ]
];

$main_text1 = '<span class="like_paragraf">Vous avez un week-end de libre?</span>
<span class="like_paragraf">Envisager de flâner dans les ruelles des villages de la Haute Vallée de l\'Orb, admirer le Canigou depuis la Coquillade, 
randonner sur le Caroux ou vers saint Michel, s\'initier à l\'escalade ou épier les mouflons dans les gorges de 
Madale, partir à la découverte de vignerons très indépendants et goûter leurs vins aux meilleures tables de la vallée, 
profiter des derniers rayons du soleil au bord de l\'Orb.</span>
<span class="like_paragraf">Et faire son lit sur la place...</span>';

$main_text2 = '<span class="like_paragraf">Nous vous proposons toute l\'année cinq jolies chambres dans notre maison de village du 19eme siècle, chacune de 
caractère mais offrant toutes un confort d\'aujourd\'hui. Vous pourrez profiter de la terrasse pour des petits 
déjeuners au soleil, ou dans la salle commune les autres jours.</span>
<span class="like_paragraf">Nos chambres peuvent accueillir de deux à quatre personnes.</span>
<span class="like_paragraf"><h5>À partir de 82€ la nuit pour 2 personnes, petit déjeuner compris.</h5></span>';

$rooms_text = 'Linge 100% coton - Savon, shampoing, linge de toilette et sèche-cheveux fournis - 
Lit parapluie disponible sur demande pour un enfant de moins de 2 ans - 
Kitchenette partagée à votre disposition sur la terrasse.';

$xtra_text = 'Virginie & Vincent Cros ont repris le <a class="text-link" href="https://www.locrerouge.fr" target="_blank" title="Restaurant l\'ocre rouge">
<b>restaurant l\'Ocre Rouge</b></a> depuis le mois de mai 2026. ils vous proposent
une cuisine créative et gourmande associant produits du Languedoc et saveurs du monde.<br/>
Menus de 25 à 39€. Réservation au 04 67 95 06 93.'; 

$region_text = 'Idéalement situé entre Toulouse et Montpellier, Hérépian et ses alentours regorgent de mille trésors à découvrir selon vos envies.<br/>
Randonnées pedestres et equestres, pistes VTT, canyoning, via ferrata, parcours d\'acrobranches, équitation, canoe-kayak, oenotourisme, marchés locaux, 
thermalisme, spéléologie, lac du Salagou, montagne du Caroux, musée et patrimoine architectural sans oublier le Parc Naturel régional du Haut-Languedoc
ou les plages du littoral...';

$biking_text = 'La labellisation <a class="text-link" href="https://www.francevelotourisme.com/accueil-velo" target="_blank" title="France-Vélo-Tourisme">
                <b>Accueil Vélo</b></a> vous garantie de trouver à votre arrivée les meilleures conditions de séjour pour vous et vos montures.
                Garage sécurisé, matériel de réparation, recharge des VAE, conseil d\'itinéraire...<br/> L\'essentiel pour une pause en toute serenité!';

$mail_dest = "lesgensdelaplace@orange.fr";
                //FONCTIONS SPÉCIFIQUES

function sendMailContact($arg_nom, $arg_prenom, $arg_mail, $arg_phone, $arg_message){

    $to = $mail_dest;
    $subject = "Nouveau message de " . $arg_nom . " " . $arg_prenom;
    $message_body = "
    Nom : $arg_nom<br/>
    Prénom : $arg_prenom<br/>
    Email : $arg_mail<br/>
    Téléphone : $arg_phone<br/>
    Message :<br/>$arg_message";

    $headers = "From : $arg_mail\r\n";
    $headers .= "reply-to: $arg_mail\r\n";

    mail($to, $subject, $body, $headers);
}

?>