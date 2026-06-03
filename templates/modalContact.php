<?php
session_start();
//echo PHP_VERSION;
//$_SESSION['csrf_token'] = bin2hex(random_bytes(32));(version php7 et >)
$_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
?>

<section id="modal-contact" class="">
    <div class="modal-header">
        <h2>CONTACTEZ-NOUS</h2>
    </div>
    <div class="modal-text"></div>
    <div class="modal-form">
        <form id="modal-contact-form" action="" method="post" >
            <fieldset>
                <legend></legend>
                <div class="form-field">
                    <label for="nom">NOM*</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-field">
                    <label for="prenom">PRÉNOM*</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-field">
                    <label for="mail">MAIL*</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div class="form-field">
                    <label for="phone">TÉLÉPHONE*</label>
                    <input type="text" id="phone" name="phone" required>

                    <!--Champs cachés sécurité-->
                        <input class="nospam" type="text" id="adress" name="adress">
                        <input type="text" class ="nospam" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <!---->

                </div>
                <div class="form-field">
                    <label for="message">VOTRE MESSAGE*</label>
                    <textarea required id="message" name="message" rows="" cols=""></textarea>
                </div>
                <div class="form-field">
                    <input type="submit" id="submit-modal-contact" name="submitName" value="<?php echo $send_message; ?>">
                    <button id="close-contact-modal">FERMER</button>
                </div>
                <div class="modal-info">(*) Champs obligatoire</div>

            </fieldset>
        </form>
    </div>
    <div class="modal-footer"></div>
</section>

