<script type='text/javascript' src='/static/js/add-user.js'></script>
<section class="tab">
    <h2>Gestion des Utilisateurs</h2>
</section>
<h2>Les Joueurs</h2>
<div class="divUsers">
    <form class="AdminFormScore" method="post" action="/admin/getScore">
        <h3>Récuperer les scores de la partie solo</h3>
        <input type='hidden' name='room_id' value='game'>
        <div id='container'>
            <label>Pseudo : </label>
            <input type="text"  placeholder="Pseudo" name="id[]" required="required"><br><br>
        </div>
        <button type='button' value='addFields' onclick='adduser()'>Ajouter un joueur</button><br>
        <input type="submit" value="Valider">
    </form>

    <form class="AdminForm" method="post" action="/admin/deleteUser">
        <h3>Supprimer un utilisateur</h3>
        <div>
            <label>Pseudo : </label>
            <input type="text"  placeholder="Pseudo" name="id" required="required"><br><br>
        </div>
        <input type="submit" value="Valider">
    </form>   
</div>


<br/>
<h2>Les Administrateurs</h2>
<div class="divUsers">
    <form class="AdminForm" method="post" action="/admin/addAdmin">
        <h3>Ajouter un administrateur</h3>
        <div>
            <label>Pseudo : </label>
            <input type="text"  placeholder="Pseudo" name="id" required="required"><br><br>
        </div>
        <input type="submit" value="Valider">
    </form>

    <form class="AdminForm" method="post" action="/admin/deleteAdmin">
        <h3>Supprimer un administrateur</h3>
        <div>
            <label>Pseudo : </label>
            <input type="text"  placeholder="Pseudo" name="id" required="required"><br><br>
        </div>
        <input type="submit" value="Valider">
    </form>  
</div>
