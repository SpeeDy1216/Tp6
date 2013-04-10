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
            echo "<h1>Partie Publique</h1>";
            echo "<a href=\"authadmin.php\">admin?</a><br/>";
            echo "<a href=\"inscrip.php\">s'inscrire?</a><br/>";
            
            $a = new pagination(5);
            
            echo "Par thème: ";
            $a->choix();            

            $a->pagin();
        ?>
    </body>
</html>
