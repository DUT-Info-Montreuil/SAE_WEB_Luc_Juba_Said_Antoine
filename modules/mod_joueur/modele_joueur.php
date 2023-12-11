<?php

require_once('connexion.php');

class ModeleJoueur extends Connexion {


    public function __construct(){}


    public function getClassementJoueur($classementType) {

        $orderBy = ($classementType === 'score') ? 'score' : 'nombre_vague';
    
        $query = self::$bdd->prepare("SELECT Utilisateur.pseudo, MAX(Partie.$orderBy) AS max_value
        FROM Partie 
        INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur 
        GROUP BY Utilisateur.pseudo 
        ORDER BY max_value DESC");
    
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>