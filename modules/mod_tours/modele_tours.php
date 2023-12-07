<?php

include_once("connexion.php");

class ModeleTours extends Connexion {
   

    public function __construct() {
        
    }

    public function getTours() {
        $sql = "SELECT * FROM Tours"; 
        $result = self::$bdd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rechercheTours($nom) {
        $sql = "SELECT * FROM tours WHERE nom LIKE :nom";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', '%' . $nom . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
