<div class="feedbacks">
<h1>Mes Feed-Back</h1>
<?php
foreach ($A_view as $A_feedback){
    echo '<div class="comment">Room : ' .$A_feedback['name'].'<br> 
        Mon note :'.$A_feedback['rating'].'/5  <br> 
        Mon commentaire :'.$A_feedback['comment'].'<br>
        <a href="#">Modifier</a> <a href="#">Supprimer</a></div>';
}
?>
</div>
