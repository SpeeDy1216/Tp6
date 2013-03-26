<?php
    include 'article.php';
    //Permet de veifier s'il y pas d'erreur
    try
    {
        //Connection a la BD
        $bdd = new PDO('mysql:host=localhost;dbname=articleblog', 'root', 'GetBackers');    
    }
    catch (Exception $e)
    {
        die('Erreur: ' . $e->getMessage());
    }
    
    $a = new article($bdd);
    
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

