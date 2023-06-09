<?php
echo '<section class="tab">
    <h2>Gestion des parties multijoueurs</h2>
    <section class="multiplayer-containers">';
    if (sizeof($A_view) == 0) {
        echo "<h3>Vous n'avez pas de salon de jeu, il est temps d'en créer !</h3>
              <h3>Utilisez le formulaire ci-dessous</h3>";
    } else {
        echo '<h3>Vos salons de jeu déjà créés</h3>';
    }
    foreach ($A_view as $A_room) {
        echo '
        <section class="rooms-already-exists">
            <p>Nom : ' . $A_room['name'] . '</p>
            <p>Code : '. $A_room['id'] .'</p>
            <p>Statut : '.Rooms::getStatus($A_room['start_date'], $A_room['end_date']).'</p>
            <p>Ouverture : '.date("j/m/Y H:i",strtotime($A_room['start_date'])).'</p>
            <p>Fermeture : '.date("j/m/Y H:i",strtotime($A_room['end_date'])).'</p>
            <a class="update-room" href="/admin/modifyroom/'. $A_room['id'] .'">Modifier 📝</a>
            <a class="update-room" href="/admin/deleteroombyid/'. $A_room['id'] .'" onclick="confirmDeleteRoom(event)">Supprimer ❌</a>
        </section>
        <script type="text/javascript" src="/static/js/confirmDeleteRoom.js"></script>';
    }
echo '
    </section>
    <section class="multiplayer-containers">
        <form id="create-room-form" action="/admin/createroom" method="post">
            <h3>Créer un salon</h3>
                <section>
                    <label for="room-name">Nom du salon :</label>
                    <input type="text" name="name" required maxlength="30">
                </section>
                <section>
                    <label for="start_date">Date d\'ouverture :</label>
                    <input type="datetime-local" name="start_date" id="start_date">
                    <label for="end_date">Date de fermeture :</label>
                    <input type="datetime-local" name="end_date" id="end_date">
                </section>
                <input type="submit" class="black-button" id="room_date" value="Créer">
        </form>
    </section>
</section>
<script type="text/javascript" src="/static/js/check-room-date-validity.js"></script>';