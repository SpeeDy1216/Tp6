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

class pagination {

    private $nbA;
    private $bdd;
    
    /**
     * Constructeur magique: initialisation des variables.
     * 
     * @param int $nbA: Le nombre d'article
     * @param string $bdd: Connection de la BD
     */
    function __construct($nbA, $bdd) {
        $this->nbA = $nbA;
        $this->bdd = $bdd;
    }

    public function getNbA() {
        return $this->nbA;
    }

    public function setNbA($nbA) {
        $this->nbA = $nbA;
    }
    
    public function getBdd() {
        return $this->bdd;
    }

    public function setBdd($bdd) {
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

        $sql = "SELECT * FROM article, themes WHERE article.id_theme = themes.id_themes ORDER BY date LIMIT $page,$articleParPage";
        $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

        while($data = $req->fetch())
        {
            echo "<br />";
            echo "<p>{$data["titre"]} <br/> ";
            echo "{$data["auteur"]} --- ";
            echo "{$data["date"]} <br/>";
            echo "{$data["texte"]} <br/>";
            echo "{$data["nom"]} <br/>";
            echo "</p>";
        }
       

       for($i=1;$i<=$nbPage;$i++){
           echo "<a href=\"index.php?p=$i\">$i</a>/";
       }
    }
}

?>
