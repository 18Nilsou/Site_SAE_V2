<div class="score">
<h1>Mes scores</h1>
<?php
foreach ($A_view as $A_score){
    echo 'Room : <strong>'.$A_score['name'].'</strong>  Mon score : '.$A_score['score'].'<br>
    <form action="/feedback" method="post">
    <input type="hidden" name="room_id" value='.$A_score['room_id'].'>
    <input type="submit" value="Faire un retour"></from><br><br>';
}
?>
</div>
