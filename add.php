<?php
    include 'liste.php';
    
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);
    
    $a = new liste();
?>

    <form method="post" action="<?php $a->add(); ?> ">
        
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
        <input type="submit" value="Envoyer" ><br/>
    </form>
   
<a href="admin.php">Retour à la page précédente</a>
