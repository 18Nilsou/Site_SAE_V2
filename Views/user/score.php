<div class="score">
<h1>Mes scores</h1>
<?php
foreach ($A_view as $A_score){
    echo 'Room : '.$A_score['name'].'  Mon score : '.$A_score['score'].' <a href="#">Faire un feed-back</a><br>';
}
?>
</div>
