<!DOCTYPE html>
<?php

      include 'configuration.php';
      include 'article.php';
      include 'pagination.php'?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tp6</title>
    </head>
    <body>
        <?php
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
            
            echo "<h1>Partie Publique</h1>";
            echo "<a href=\"admin.php\">admin?</a>";
            
            $a = new pagination(5, $bdd);
            $a->pagin();
        ?>
    </body>
</html>
