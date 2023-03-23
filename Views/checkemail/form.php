<section id="form-container">
    <form class="signForm" method="post" action="checkemail">
        <h2 class="form-title">Vérification de l'email</h2>
        <label for="id">Pseudo :</label>
        <input class="id-form-input" type="text" placeholder="Votre pseudo" name="id" required>
        <label for="token">Token :</label>
        <input class="id-form-input" type="number" name="token" required>
        <input type="hidden" name="password" value="<?php echo($A_view['password'])?>">
        <input type="hidden" name="name" value="<?php echo($A_view['name'])?>">
        <input type="hidden" name="lastname" value="<?php echo($A_view['lastname'])?>">
        <input type="hidden" name="email" value ="<?php echo($A_view['email'])?>">
        <input class="submit" type="submit" value="Valider">
    </form>
</section>
<script type='text/javascript' src='/static/js/password-visibility.js'></script>