<div class="feedbacks">
<h1>Mes Feed-Back</h1>
<?php

foreach ($A_view as $A_feedback){
    echo '<div class="comment">Room : ' .$A_feedback['name'].'<br> 
        Mon note :'.$A_feedback['rating'].'/5  <br> 
        Mon commentaire :'.$A_feedback['comment'].'<br>
        <form method="post" action="/feedback/delete">
        <input type="hidden" name="id" value="'.$A_feedback['id'].'">
        <input type="submit" value="Suprimer">
        </form>
        <form method="post" action="feedback/editForm">
        <input type="hidden" name="id" value="'.$A_feedback['id'].'">
        <input type="hidden" name="rating" value="'.$A_feedback['rating'].'">
        <input type="hidden" name="comment" value="'.$A_feedback['comment'].'">
        <input type="hidden" name="room_id" value="'.$A_feedback['room_id'].'">
        <input type="hidden" name="user_id" value="'.$A_feedback['user_id'].'">
        <input type="submit" value="Modier">
        </form>
        </div>';
}
?>
</div>
