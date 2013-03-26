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
 
    $a->supp();
?>
