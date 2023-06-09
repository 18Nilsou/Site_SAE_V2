<?php
echo '<section class="tab">
    <h2>Modification de la salle : '. $A_view['room']['name'] .'</h2>
    <section class="multiplayer-containers">
        <form action="/admin/inviteusers" method="post">
            <h3>Inviter des utilisateurs</h3>
            <section id="invite-users-form">
                <label>Liste des utilisateurs </label>
                <input type="hidden" name="roomId" value='. $A_view['room']['id'] .'>
                <textarea id="invite-users-list" type="text" name="userList" placeholder="example1@gmail.com,example2@gmail.com" required></textarea>
                <input class="black-button" type="submit" id="invite-users-submit">
            </section>
        </form>
        <form id="unsuscribe-user-form" action="/admin/blacklistuser" method="post">
            <input type="hidden" name="roomId" value="'.$A_view['room']['id'].'">
            <section>
                <select name="user_id" id="dropdown-user">
                    <option>Un utilsateur à désinscrire ?</option>';
                    foreach ($A_view['guestUsers'] as $user) {
                        echo '<option value="'.$user['id'].'">'.$user['name']." ".$user['lastname'].'</option>';
                    }
                    echo '
                </select>
                <input type="submit" class="black-button" value="Désinscrire">
            </section>
        </form>';
        if (isset($A_view['unSignedUsers']) && $A_view['unSignedUsers'] != []) {
            $S_users = '';
            echo '<h3>Utilisateurs qui n\'ont pas été invités car ils ne sont pas inscrits</h3>';
            foreach ($A_view['unSignedUsers'] as $user) {
                $S_users .= $user .  " ";
            }
            echo '<p id="unSignedUsers">'.$S_users.'</p>';
        }
 echo '</section>
        <section class="multiplayer-containers">';

if (isset($A_view['topFive'])){
    echo '<h3>Top 5</h3>
    <section id="top5"> <p>';
    foreach($A_view['topFive'] as $A_score){
        echo ($A_score['score']. ' : ' .$A_score['user_id'].' '.$A_score['name'].' ' .$A_score['lastname'] . '<br><br>');
    }
    echo "</p></section>";
}

echo'
        <h3>Recupérer les scores</h3>
        <form action="/admin/getScoreRoom" method="post" id="getScore">
                <input type="hidden" name="room_id" value='.$A_view['room']['id'].'>
                <input type="submit" value="Récuperer">
        </form>
        </section>
';
echo '
<section class="multiplayer-containers">
<h3>Les commentaires</h3>';
if (isset($A_view['feedback'])){

   echo' <div class="feedbacks">';
foreach ($A_view['feedback'] as $A_feedback){
    echo '<div class="comment">
            <p>De '.$A_feedback['user_id'] .' ' .$A_feedback['name'] .' '.$A_feedback['lastname'].' <br><br>
                Note : '.$A_feedback['rating'].'/5  <br> 
                Le commentaire : '.$A_feedback['comment'].'</p>
            <br>
        </div>';
}
echo'</div>';
}else{
    echo '<h3>Pas de commentaire</h3>';
}

echo '</section>';

echo '
            
    <section class="multiplayer-containers">
         <form action="/admin/modifyroomdates" method="post">
            <h3>Modification date d\'ouverture et de fermeture de la salle</h3>
            <section id="invite-users-form">
                <label>Date d\'ouverture : </label>
                <input type="hidden" name="roomId" value='. $A_view['room']['id'] .'>
                <input type="datetime-local" name="start_date" id="start_date" required>
                <label>Date de fermeture : </label>
                <input type="datetime-local" name="end_date" id="end_date" required>
                <input class="black-button" type="submit" id="room_date">
            </section>
        </form>
    </section>
    <section class="arrayQuestion">';
        echo '
            <form class="questionForm" method="post" action="/admin/addRoomQuestion">
                <h3>Ajouter une question</h3>
                <input type="hidden" name="room_id" value='. $A_view['room']['id'] .'>
                <label>Titre de la question : </label>
                <input type="text"  placeholder="Titre" name="title" required="required" maxlength="100"><br/>
                <label>Consigne :</label>
                <textarea name="assignement" rows="5" cols="30"  placeholder="Consigne" aria-required="true" maxlength="500"></textarea><br/>
                <label>Réponse : </label>
                <input type="text"  placeholder="Réponse" name="answer" required="required" maxlength="500"><br/>
                <label>Indice : </label>
                <textarea name="suggestion" rows="5" cols="30"  placeholder="Indice" aria-required="true" maxlength="500"></textarea><br/>
                <input type="submit" value="Valider">
            </form>';
        echo($A_view['questions']);
echo '
    </section>
</section>
<script type="text/javascript" src="/static/js/check-room-date-validity.js"></script>
<script type="text/javascript" src="/static/js/modify-questions.js"></script>';