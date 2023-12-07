<?php

require_once('connexion.php');

class ModeleJoueur extends Connexion {


    public function __construct(){}


    public function getClassementJoueurParScore(){
        $query = self::$bdd->prepare("SELECT * FROM Partie ORDER BY score DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getClassementJoueurParNiveau() {

    }

}

?>