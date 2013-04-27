<?php
/**
 * EDIT.PHP permet d'editer un article
 */
    include 'liste.php';
    
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);
    
    $a = new liste();
    
    $sql="SELECT * FROM article WHERE id={$_GET["id"]}";
    $req = $bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
    $data = $req->fetch();
   
 ?>

    <form method="post" action="<?php $a->edit(); ?> ">
        <input name ="id" type="hidden" value="<?php echo $data["id"]; ?>"/>
        Titre :<input type="text" name="titre" value="<?php echo $data["titre"]; ?>"/><br />
        Contenu: <textarea name ="contenu" style="width: 100%;height: 150px;"><?php echo $data["texte"]; ?></textarea><br />
        <input type="submit" value="Envoyer" >
    </form>

