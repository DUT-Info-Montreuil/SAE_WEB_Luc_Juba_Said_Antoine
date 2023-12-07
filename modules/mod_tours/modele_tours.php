<?php

include_once("connexion.php");

class ModeleTours extends Connexion {
   

    public function __construct() {
        
    }

    public function getTours() {
        $sql = "SELECT * FROM tours"; // Assurez-vous que 'tours' est le nom de votre table
        $result = self::$bdd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
