<form class="signForm" method="post" action="signup/register">
    <h2 class="form-title">Inscription</h2>
    <label for="id">Pseudo :</label>
    <input class="id-form-input" type="text" placeholder="Votre pseudo" name="id" required>
    <label for="id">Email :</label>
    <input class="id-form-input" type="email" placeholder="Votre email" name="email" title="Entrez un email valide" required>
    <label for="password">Mot de passe :</label>
    <input class="id-form-input" id="password" type="password" placeholder="Votre mot de passe" name="password" title="Au moins 12 caractères, un chiffre, une lettre majuscule, une minuscule et un caractère spécial" minlength="12" required >
    <label for="passwordConfirm">Confirmation de passe :</label>
    <input class="id-form-input" id="password_confirm" type="password" placeholder="Confirmation du mot de passe" title="Confirmation du mot de passe" required >
    <p class="redirections-sign">Déjà inscris ? <a href="/signin">Connectez vous !</a></p>
    <input class="submit" type="submit">
</form>
<script type='text/javascript' src='/static/js/password-check.js'></script>
