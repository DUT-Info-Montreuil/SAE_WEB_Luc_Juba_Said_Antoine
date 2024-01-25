<?php

include_once "connexion.php";


class ModeleTours extends Connexion
{


    public function __construct()
    {

    }

    public function getTours()
    {
        $sql = "SELECT * FROM Tours";
        $result = self::$bdd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function rechercheTours($nom)
    {
        $sql = "SELECT * FROM Tours WHERE nom = :nom";
        $stmt = self::$bdd->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function rechercheToursParNom($searchTerm)
    {
        $sql = self::$bdd->prepare("SELECT * FROM Tours WHERE nom LIKE ?");
        $sql->execute(array('%' . $searchTerm . '%'));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

public function updateTour() {
    if(isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['degat']) && isset($_POST['description']) && isset($_POST['id'])) {
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $degat = $_POST['degat'];
        $description = $_POST['description'];
        $id = $_POST['id'];

        $query = self::$bdd->prepare("UPDATE Tours SET nom = ?, prix = ?, degat = ?, description = ? WHERE id_tour = ?");
        $res = $query->execute([$nom, $prix, $degat, $description, $id]);

        return $res; 
    } else {
        return false;
    }
}



}
?>