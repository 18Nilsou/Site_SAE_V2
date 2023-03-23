<section id="form-container">
    <form class="signForm" method="post" action="/feedback/add">
        <h2 class="form-title">Mettre un commentaire</h2>    
        <input type="hidden" name ="room_id" value="<?php echo($A_view["room_id"]) ?>">
        <input type="hidden" name ="user_id" value="<?php echo(Session::getSession()['id']) ?>">
        <label for="rating">Note :</label>
        <input class="id-form-input" type="number" name="rating" max="5" min="0" required><br>
        <label for="comment">Commentaire :</label><br>
        <textarea placeholder="Entrez votre commantaire" name="comment" maxlength="255" cols="50" rows="7" required></textarea><br>
        <input type="submit" value="Envoyer">
    </form>
</section>