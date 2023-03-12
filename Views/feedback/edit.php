<form method="post" action="/feedback/edit">
    <input type="hidden" name ="id" value="<?php echo($A_view["id"]) ?>">
    <input type="hidden" name ="user_id" value="<?php echo($A_view["user_id"]) ?>">
    <input type="hidden" name ="room_id" value="<?php echo($A_view["room_id"]) ?>">
    <label for="rating">Note :</label>
    <input type="number" name="rating" max="5" min="0" value="<?php echo($A_view["rating"]) ?>" required><br>
    <label for="comment">Commentaire :</label><br>
    <textarea placeholder="Entrez votre commantaire" name="comment" maxlength="255" cols="50" rows="7" required><?php echo($A_view["comment"]) ?></textarea><br>
    <input type="submit" value="Envoyer">
</form>