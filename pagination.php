<?php

/**
 * Description de pagination:
 * 
 * Gére la pagination: le nombre d'article par page
 *
 * @author karimjy
 * @version 1.0
 * @copyright (c) 2013, Irfann Karimjy
 */

require_once ('configuration.php');
require_once ('article.php');

class pagination {

    private $nbA;
    private $bdd;
    
    /**
     * Constructeur magique: initialisation des variables: connexion à la base de donnée.
     * 
     * @param int $nbA: Le nombre d'article
     */
    function __construct($nbA) {
        try
        {
            //Connection a la BD
            $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_BDD, DB_LOGIN, DB_PASS);    
        }
        catch (Exception $e)
        {
            die('Erreur: ' . $e->getMessage());
        }
        $this->nbA = $nbA;
        $this->bdd = $bdd;
    }


    /**
     * Fonction pagin: Permet la pagination, le nombre d'article est définie par l'utilisateur
     * 
     * Description des étapes:
     * Cette fonction initialise le nombre le nombre d'article par page saisie par l'utilisateur.
     * Ensuite elle fait une requête pour connaître le nombre d'article dans la BD.
     * Puis calcul le nombre de pages(total/leNombreArticle), enfin elle l'affiche les articles par ordre de date.
     */ 
    public function pagin(){
        $articleParPage = $this->nbA;

        $sql = "SELECT COUNT(*) as nbArticle FROM article";
        $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
        $data = $req->fetch();

        if(isset($_GET['p'])){
            $cpage = $_GET['p'];
        }
        else{
            $cpage = 1;
        }

        $page = ($cpage - 1)*$articleParPage;

        $nbArticle = $data["nbArticle"];
        $nbPage = ceil($nbArticle / $articleParPage);

        $sql = "SELECT * FROM article, themes WHERE article.id_theme = themes.id_themes ORDER BY date DESC LIMIT $page,$articleParPage";
        $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
        
        $a = new article();
        $a->afficher($req);
        

       for($i=1;$i<=$nbPage;$i++){
           echo "<a href=\"index.php?p=$i\">$i</a>/";
       }
    }
    
    /**
     * Fonction choix permet de choisir un theme et d'afficher les articles de ce theme
     */
    public function choix(){
        ?>
            <form method="post">
            <select name="theme">
                <?php
                    $sql = "SELECT * FROM themes";
                    $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
                    
                    while($data = $req->fetch()){
                      echo "<option name={$data["id_themes"]} value={$data["id_themes"]}>{$data["nom"]}</option>";
                    }
                ?>
            </select>
                <input name="cate" type='submit' value='valider' onClick="<?php $this->selecte(); ?>">
            </form>
            <?php if(isset($_POST['cate'])) {
                $this->selecte();
            }?>
       <?php
    }
 
    public function selecte(){
        if(!empty($_POST['theme'])){
            extract($_POST);
            $sql = "SELECT * FROM article, themes WHERE article.id_theme={$theme} AND article.id_theme = themes.id_themes";
            $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
            
            $a = new article();
            $a->afficher($req);
        }
    }
}

?>
