<?php
/**
 * INSCRIP.PHP permet de s'inscrire
 */
    include 'user.php';

    $user = new user();
?>

    <form method="post" action="<?php $user->creer() ?>">
        <input name ="id" type="hidden" value=""/>
        Nom d'utilisateur :<input type="text" name="nom" value=""/><br />
        Mot de passe :<input type="text" name="mdp" value=""/><br />
        <input type="submit" value="Envoyer" >
    </form>
