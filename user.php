<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description de user
 * 
 * Cette classe permet de créer des utilisateurs
 * 
 * @author karimjy
 * @version 1.0
 * @copyright (c) 2013, Irfann Karimjy
 */
require_once ('configuration.php');

class user {
    private $bdd;
    
    function __construct() {
        try
        {
            //Connection a la BD
            $bdd = new PDO('mysql:host=localhost;dbname=articleblog', 'root', 'GetBackers');    
        }
        catch (Exception $e)
        {
            die('Erreur: ' . $e->getMessage());
        }
        $this->bdd = $bdd;
    }
    
    public function creer(){
        if(!empty($_POST)){
            extract($_POST);
            
            $mdp = sha1($mdp);
            $sql = "INSERT INTO user (nomUser, mdp) VALUES ('$nom', '$mdp')";
            $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());

            header("Location: index.php");
        }
    }
    
    public function auth(){
        if(!empty($_POST)){
            extract($_POST);
            
            
            $correct = false;
            
            $sql="SELECT nomUser, mdp, acces FROM user";
            $req = $this->bdd->query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.  mysql_error());
            
            while($data = $req->fetch()){
                $mdps = sha1($mdp);    
                
                if($data["mdp"] == $mdps && $data["nomUser"] == $name && $data["acces"] == 1){
                    header("Location: admin.php");
                    $correct = true;
                }
            }
            
            if($correct == false){
                header("Location: authadmin.php");
            }
           
        }
    }
}

?>
