<?php
/**
 * Description de la classe:
 * 
 * Classe article: gére les articles
 * 
 * @author karimjy
 * @version 1.0
 * @copyright (c) 2013, Irfann Karimjy
 */
require_once ('configuration.php');

    class article{
        private $bdd;
        
        /**
         * Constructeur magique: initialisation des variables: connexion à la base de donnée.
         * 
         * @param string $bdd: Connection à la BD
         */
        function __construct($a, $au, $t) {
            try
            {
                //Connection a la BD
                $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);   
            }
            catch (Exception $e)
            {
                die('Erreur: ' . $e->getMessage());
            }
            
        }
        

        /**
         * Fonction afficher permet d'afficher ce qu'il y la dans la base de donnée avec une requête mise en paramétre.
         * @param type $req: variable qui la requete
         */
        public function afficher($req){
            while($data = $req->fetch())
            {
                echo "<br />";
                echo "<p>{$data["titre"]} <br/> ";
                echo "{$data["auteur"]} --- ";
                echo date('d/m/Y',strtotime($data["date"]))."<br/>";
                echo "{$data["texte"]} <br/>";
                echo "{$data["nom"]} <br/>";
                echo "</p>";
            }
        }
        
        
        
        public function addTheme(){
            if(!empty($_POST["add"])){
                extract($_POST);
                $sql = "INSERT INTO themes(nom) VALUES('$addtheme')";
                $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
                
                header("Location: admin.php");
            }
        }
        
        public function suppTheme(){
            if(!empty($_POST["supp"])){
                extract($_POST);
                $sql = "DELETE FROM themes WHERE id_themes=".$supptheme."";
                $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

                header("Location: admin.php");
            }
        }  
    }
?>
