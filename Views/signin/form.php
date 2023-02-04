<form class="signForm" method="post" action="signin/connect">
    <label for="id">Pseudo :</label>
    <input type="text" placeholder="Rentrez votre pseudo" name="id" class="input" required>
    <label for="password">Mot de passe :</label>
    <input type="password" placeholder="Rentrez votre mot de passe" class="input" name="password" required>
    <?php if(isset($A_view)){
        var_dump($A_view);
        }?>
    <input id="submit" type="submit">
</form>