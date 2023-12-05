<?php

class Connexion {

    protected static $bdd;
    
    public static function init_Connexion() {
   
        $dsn = "?";
        $username = "?";
        $password = "?";
        
        try {
            self::$bdd = new PDO($dsn, $username, $password);
        }catch(PDOException $e) {
            die("Error: ".$e->getMessage());
        }
    }
}

?>