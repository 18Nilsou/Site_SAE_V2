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
                <input class="black-button" type="submit">
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
        </form>
    </section>
    <section class="arrayQuestion">';
        echo '
            <form class="questionForm" method="post" action="/admin/addRoomQuestion">
                <h3>Ajouter une question</h3>
                <input type="hidden" name="room_id" value='. $A_view['room']['id'] .'>
                <label>Titre de la question : </label>
                <input type="text"  placeholder="Titre" name="title" required="required"><br/>
                <label>Consigne :</label>
                <textarea name="assignement" rows="5" cols="30"  placeholder="Consigne" aria-required="true"></textarea><br/>
                <label>Réponse : </label>
                <input type="text"  placeholder="Réponse" name="answer" required="required"><br/>
                <label>Indice : </label>
                <textarea name="suggestion" rows="5" cols="30"  placeholder="Indice" aria-required="true"></textarea><br/>
                <input type="submit" value="Valider">
            </form>';
        echo($A_view['questions']);
echo '
    </section>
</section>';