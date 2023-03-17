<div class="user">
<h1>Mon compte</h1>
<div class="compte">
<h1>Mon Profile</h1>
<?php
echo '
Pseudo : '.$A_view['id'].'<br><br>
Prenom : '.$A_view['name'].'<br><br>
Nom :  '.$A_view['lastname'].'<br><br>
email :  '.$A_view['email'].'<br><br><br>
<a href="retrievepassword">Modifier le mot de passe</a>
';
?>
</div>
