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
?>

    <form method="post" action="<?php $a->add(); ?> ">
        <input name ="id" type="hidden" value=""/>
        Titre :<input type="text" name="titre" value=""/>
        Auteur :<input type="text" name="auteur" value=""/><br/>
        Contenu :<textarea name ="texte" style="width: 100%;height: 150px;"></textarea><br />
        Theme :<select name="theme">
                <?php 
                      $sql = "SELECT * FROM themes";
                      $req = $bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
                      
                      while($data = $req->fetch()){
                        echo "<option name={$data["id_themes"]} value={$data["id_themes"]}>{$data["nom"]}</option>";
                      } 
                ?>
               </select>
        <input type="submit" value="Envoyer" >
    </form>
