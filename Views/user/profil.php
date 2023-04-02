<div class="user">
<h1>Mon compte</h1>
<div class="compte">
<h1>Mon Profil</h1>
<?php
echo '
<p>
Pseudo : '.$A_view['id'].'<br><br>
Prenom : '.$A_view['name'].'<br><br>
Nom :  '.$A_view['lastname'].'<br><br>
email :  '.$A_view['email'].'<br><br><br></p>
<a href="retrievepassword">Modifier le mot de passe</a>
';
?>
</div>
