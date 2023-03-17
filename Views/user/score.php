<h1>Mes scores</h1>
<div class="scores">
<?php
foreach ($A_view as $A_score){
    echo '<div>
    <p> Room : <strong>'.$A_score['name'].'</strong> </p>
    <p> Mon score : '.$A_score['score'].' </p>
    <form action="/feedback" method="post">
    <input type="hidden" name="room_id" value='.$A_score['room_id'].'>
    <input type="submit" value="Faire un retour"></from></div>';
}
?>
</div>
