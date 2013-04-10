<?php
    include 'user.php';

    $user = new user();
    
?>
    <form method="post" action="<?php $user->auth() ?>">
        <input name ="id" type="hidden" value=""/>
        Nom d'utilisateur :<input type="text" name="name" value=""/><br />
        Mot de passe :<input type="password" name="mdp" value=""/><br />
        <input type="submit" value="Envoyer" >
    </form>