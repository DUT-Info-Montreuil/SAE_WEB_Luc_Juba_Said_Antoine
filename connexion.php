<?php

class Connexion {

    protected static $bdd;
    
    public static function init_Connexion() {
   
        $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201645";
        $username = "dutinfopw201645";
        $password = "veruvehy";
        
        try {
            self::$bdd = new PDO($dsn, $username, $password);
        }catch(PDOException $e) {
            die("Error: ".$e->getMessage());
        }
    }
}

?>