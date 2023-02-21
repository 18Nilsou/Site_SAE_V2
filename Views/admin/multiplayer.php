<?php
echo '<section class="tab">
    <h2>Gestion des parties multijoueurs</h2>
    <section class="multiplayer-containers">
        <h3>Vos salons de jeu déjà créés</h3>';
    foreach ($A_view as $A_room) {
        echo '
        <section class="rooms-already-exists">
            <p>Nom : ' . $A_room['name'] . '</p>
            <p>Code : '. $A_room['id'] .'</p>
            <p>Statut : '.Rooms::getLiterralStatus($A_room['started']).'</p>
        </section>';
    }
echo '
    </section>
    <section class="multiplayer-containers">
        <form id="create-room-form" action="/admin/createroom" method="post">
            <h3>Créer un salon</h3>
            <section>
                <label>Nom du salon </label>
                <input type="text" name="name" required>
                <input type="submit">
            </section>
        </form>
    </section>
</section>';