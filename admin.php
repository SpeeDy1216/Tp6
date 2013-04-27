<?php
/**
 * ADMIN.PHP permet d'afficher les articles pour les admins
 */
    include 'configuration.php';

    try
    {
        //Connection a la BD
        $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);   
    }
    catch (Exception $e)
    {
        die('Erreur: ' . $e->getMessage());
    }

    echo "<h1>Partie Admin</h1>";
    echo "<a href=\"index.php\">partie publique?</a> <a href=\"add.php\">ajouter un article</a> ";
    echo "<a href=\"theme.php\">ajouter un theme</a>";

    $sql = "SELECT * FROM article, themes WHERE article.id_theme = themes.id_themes ORDER BY article.date DESC";
    $req = $bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

  while($data = $req->fetch())
    {
        echo "<br />";
        echo "<p>{$data["titre"]} <a href=\"edit.php?id={$data['id']}\">modifier</a>
              --- <a href=\"suppr.php?id={$data["id"]}\">supprimer</a><br/>";
        echo "{$data["auteur"]} --- ";
        echo date('d/m/Y',strtotime($data["date"]))."<br/>";
        echo "{$data["texte"]} <br/>";
        echo "{$data["nom"]} <br/>";
        echo "</p>";

    }
        
        
?>
