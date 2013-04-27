<?php
    /**
     * THEME.PHP permet d'ajouter ou supprimer un theme
     */
    include 'article.php';
    
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);
    
    $a = new article();
    
    echo "Ajouter un theme";
?>


    <form method="post"> 
        Ajouter Theme :<input type="text" name="addtheme" value=""/>
        <input name="add" type="submit" value="Envoyer" onClick="<?php $a->addTheme()?>"><br/>
    </form>

    <form method="post">
        Supprimer Theme : <select name="supptheme">
                          <?php $sql = "SELECT * FROM themes";
                          $req = $bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

                          while($data = $req->fetch()){
                            echo "<option name={$data["id_themes"]} value={$data["id_themes"]}>{$data["nom"]}</option>";
                          } ?>
                         </select>
           <input name="supp" type="submit" value="Envoyer" onClick="<?php $a->suppTheme()?>">
    </form>

<a href="admin.php">Retour à la page précédente</a>