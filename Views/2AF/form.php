<section id="form-container">
    <form class="signForm" method="post" action="twoauth">
        <h2 class="form-title">Double Authentication</h2>
        <label for="id">Pseudo :</label>
        <input class="id-form-input" type="text" placeholder="Votre pseudo" name="id" required>
        <label for="token">Token :</label>
        <input class="id-form-input" type="number" name="token" required>
        <input class="submit" type="submit" value="Valider">
    </form>
</section>
<script type='text/javascript' src='/static/js/password-visibility.js'></script>