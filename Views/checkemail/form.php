<?php
    echo'
    <form method="post" action="Checkemail/steptwo"> 
    <input type="text" name="id" placeholder="Pseudo"><br>
    <input type="number" name="token" placeholder="token"><br>
    
    <input type="hidden" name="email" value="'.$A_view["email"].'">
    <input type="hidden" name="password" value="'.$A_view["password"].'">
    <input type="hidden" name="name" value="'.$A_view["name"].'">
    <input type="hidden" name="lastname" value="'.$A_view["lastname"].'">
    <input type="submit" value="Valider">
    </form>';
    ?>
