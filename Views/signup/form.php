<<?php
echo '
<section id="form-container">
    <form class="signForm" method="post" action="/Signup/register">
        <h2 class="form-title">Inscription</h2>
        <label for="id">Pseudo :</label>
        <input class="id-form-input" type="text" placeholder="Votre pseudo" name="id" required>';
        if(isset($A_view['error'])) {
            echo '<p>' . $A_view['error'] . '</p>';
        }
echo '
        <label for="id">Email :</label>
        <input class="id-form-input" type="email" placeholder="Votre email" name="email" title="Entrez un email valide" required>
        <label for="id">Nom :</label>
        <input class="id-form-input" type="text" placeholder="Votre nom" name="lastname" title="Entrez votre nom" required>
        <label for="id">Prénom :</label>
        <input class="id-form-input" type="text" placeholder="Votre prénom" name="name" title="Entrez votre prénom" required>
        <label for="password">Mot de passe :</label>
        <label class="password-container">
            <input class="id-form-input" id="password" type="password" placeholder="Votre mot de passe" name="password" title="Au moins 12 caractères, un chiffre, une lettre majuscule, une minuscule et un caractère spécial" minlength="12" required >
            <img class="show-password-icon" id="password-icon-off" src="/static/pictures/password-visibility-icon/visibility-off.png">
            <img class="show-password-icon" id="password-icon-on" src="/static/pictures/password-visibility-icon/visibility-on.png">
        </label>
        <label for="passwordConfirm">Confirmation de passe :</label>
        <input class="id-form-input" id="password_confirm" type="password" placeholder="Confirmation du mot de passe" title="Confirmation du mot de passe" required >
        <p class="redirections-sign">Déjà inscris ? <a href="/signin">Connectez vous !</a></p>
        <input class="submit" type="submit">
    </form>
</section>
<script type="text/javascript" src="/static/js/password-check.js"></script>
<script type="text/javascript" src="/static/js/password-visibility.js"></script>';
