<?php
echo '<section class="tab">
    <h2>Modification de la salle : '. $A_view['name'] .'</h2>
    <section class="multiplayer-containers">
        <form action="/admin/inviteusers" method="post">
            <h3>Inviter des utilisateurs</h3>
            <section id="invite-users-form">
                <label>Liste des utilisateurs </label>
                <input type="hidden" name="roomId" value='. $A_view['id'] .'>
                <textarea id="invite-users-list" type="text" name="userList" placeholder="example1@gmail.com,example2@gmail.com" required></textarea>
                <input class="black-button" type="submit">
            </section>
        </form>
    </section>
</section>';