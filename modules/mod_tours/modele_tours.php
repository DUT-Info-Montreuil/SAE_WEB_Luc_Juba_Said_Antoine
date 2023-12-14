<?php

include_once "connexion.php";


class ModeleTours extends Connexion {
   

    public function __construct() {
        
    }

    public function getTours() {
        $sql = "SELECT * FROM Tours"; 
        $result = self::$bdd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function rechercheTours($nom) {
        $sql = "SELECT * FROM tours WHERE nom = :nom";
        $stmt = self::$bdd->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function rechercheToursParNom($searchTerm) {
        $sql = self::$bdd->prepare("SELECT * FROM tours WHERE nom LIKE ?");
        $sql->execute(array('%' . $searchTerm . '%'));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
?>
