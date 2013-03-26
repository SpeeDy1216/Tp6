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
    class article{
        private $bdd;
        
        /**
         * Constructeur magique: initialisation des variables
         * 
         * @param string $bdd: Connection à la BD
         */
        function __construct($bdd) {
            $this->bdd = $bdd;
        }
        
        public function getBdd() {
            return $this->bdd;
        }

        public function setBdd($bdd) {
            $this->bdd = $bdd;
        }

        /**
         * Fonction add: permet d'ajouter un article
         */
        public function add(){
            if(!empty($_POST)){
                extract($_POST);
             //   $idd = $_POST[$data['theme']];
     
                $sql="INSERT INTO article (titre,auteur,texte, id_theme) VALUES('$titre','$auteur', '$texte', '$theme')";
                $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
                
            //    header("Location: admin.php");
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
