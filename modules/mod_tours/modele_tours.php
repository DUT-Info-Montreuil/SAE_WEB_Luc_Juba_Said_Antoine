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

    public function rechercheToursParNom() {
        //$sql = "SELECT * FROM tours WHERE nom LIKE :searchTerm";
        $sql = self::$bdd->prepare("SELECT * FROM tours WHERE nom LIKE ?");
        $sql->execute(array($_POST['search']));
        $res = $sql->fetch();

        return $res;
       // $stmt = self::$bdd->prepare($sql);
        //$stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        //$stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
?>
