<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of liste
 *
 * @author karimjy
 */
require_once 'article.php';

class liste {
   private $bdd;
        
    /**
     * Constructeur magique: initialisation des variables: connexion à la base de donnée.
     * 
     * @param string $bdd: Connection à la BD
     */
    function __construct() {
        try
        {
            //Connection a la BD
            $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);   
        }
        catch (Exception $e)
        {
            die('Erreur: ' . $e->getMessage());
        }

        $this->bdd = $bdd;
    }
    
    /**
    * Fonction add: permet d'ajouter un article
    */
   public function add(){
       if(!empty($_POST)){
           extract($_POST);

           $sql="INSERT INTO article (titre, auteur, texte, id_theme) VALUES('$titre','$auteur', '$texte', '$theme')";
           $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

           header("Location: admin.php");
       }

   }

   /**
    * Fonction supp: Permet de supprimer un article
    */
   public function supp(){
       $sql = "DELETE FROM article WHERE id={$_GET["id"]}";
       $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

       header("Location: admin.php");
   }

   /**
    * Fonction edit: Permet de modifier un article
    */
   public function edit(){
       if(!empty($_POST)){
           extract($_POST);
           $sql = "UPDATE article SET titre='$titre', texte='$contenu' WHERE id={$_GET["id"]}";
           $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
           echo "News modifiée";
           $_GET["id"] = $id;
           header("Location: admin.php");
       }

   }
}

?>
