<form class="signForm" method="post" action="signin/connect">
    <h2 class="form-title">Connexion</h2>
    <label for="id">Pseudo :</label>
    <input class="id-form-input" type="text" placeholder="Votre pseudo" name="id" required>
    <label for="password">Mot de passe :</label>
    <label class="password-container">
        <input class="id-form-input" type="password" placeholder="Votre mot de passe" name="password" required>
        <img class="show-password-icon" id="password-icon-off" src="/static/pictures/password-visibility-icon/visibility-off.png">
        <img class="show-password-icon" id="password-icon-on" src="/static/pictures/password-visibility-icon/visibility-on.png">
    </label>
    <p class="redirections-sign">Pas de compte ? <a href="/signup">Créez en un !</a></p>
    <p class="redirections-sign"><a href="retrievepassword">Mot de passe oublié</a></p>
    <input class="submit" type="submit" value="Se connecter">
</form>
<script type='text/javascript' src='/static/js/password-visibility.js'></script>