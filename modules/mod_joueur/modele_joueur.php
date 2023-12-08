<?php

require_once('connexion.php');

class ModeleJoueur extends Connexion {


    public function __construct(){}


    public function getClassementJoueurParScore(){

        $query = self::$bdd->prepare("SELECT Utilisateur.pseudo, MAX(Partie.score) AS scoreMax
        FROM Partie 
        INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur 
        GROUP BY Utilisateur.pseudo 
        ORDER BY MAX(Partie.score) DESC");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getClassementJoueurParNiveau() {

    }

}

?>