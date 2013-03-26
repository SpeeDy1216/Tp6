<?php
      include 'configuration.php';
      include 'article.php';
      include 'pagination.php';
      
      try
        {
            //Connection a la BD
            $bdd = new PDO('mysql:host=localhost;dbname=articleblog', 'root', 'GetBackers');    
        }
        catch (Exception $e)
        {
            die('Erreur: ' . $e->getMessage());
        }
        
        echo "<h1>Partie Admin</h1>";
        echo "<a href=\"index.php\">partie publique?</a> <a href=\"add.php\">ajouter un article</a>";
        
        $sql = "SELECT * FROM article, themes WHERE article.id_theme = themes.id_themes ORDER BY date";
        $req = $bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

      while($data = $req->fetch())
        {
            echo "<br />";
            echo "<p>{$data["titre"]} <a href=\"edit.php?id={$data['id']}\">modifier</a>
                  --- <a href=\"suppr.php?id={$data["id"]}\">supprimer</a><br/>";
            echo "{$data["auteur"]} --- ";
            echo "{$data["date"]} <br/>";
            echo "{$data["texte"]} <br/>";
            echo "{$data["nom"]} <br/>";
            echo "</p>";
        
        }
        
        
?>
