<?php
echo '<section class="tab">
    <h2>Gestion des parties multijoueurs</h2>
    <section class="multiplayer-containers">
        <h3>Vos salons de jeu actifs</h3>
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