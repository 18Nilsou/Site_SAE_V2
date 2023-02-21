<script type='text/javascript' src='/static/js/add-user.js'></script>
<section class="tab">
    <h2>Gestion des Utilisateurs</h2>
</section>
<h2>Les Joueurs</h2>
<h3>Récuperer les scores de la partie solo</h3>
<form class="AdminForm" method="post" action="/admin/getScore">
    <input type='hidden' name='room_id' value='D4E5F6'>
    <div id='container'>
        <label>Pseudo : </label>
        <input type="text"  placeholder="Pseudo" name="id[]" required="required"><br><br>
    </div>
    <button type='button' value='addFields' onclick='adduser()'>Ajouter un joueur</button><br>
    <input type="submit" value="Valider">
</form>
<h3>Supprimer un Utilisateur</h3>
<form class="AdminForm" method="post" action="/admin/deleteUser">
    <label>Pseudo : </label>
    <input type="text"  placeholder="Pseudo" name="id" required="required">
    <input type="submit" value="Valider">
</form>

<br/>
<h2>Les Administrateurs</h2>
<h3>Ajouter un administrateur</h3>
<form class="AdminForm" method="post" action="/admin/addAdmin">
    <label>Pseudo : </label>
    <input type="text"  placeholder="Pseudo" name="id" required="required">
    <input type="submit" value="Valider">
</form>
<h3>Supprimer un administrateur</h3>
<form class="AdminForm" method="post" action="/admin/deleteAdmin">
    <label>Pseudo : </label>
    <input type="text"  placeholder="Pseudo" name="id" required="required">
    <input type="submit" value="Valider">
</form>