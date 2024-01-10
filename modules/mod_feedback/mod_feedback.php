<?php
// mod_feedback.php

require_once 'connexion.php';

class ModFeedback {
    
    protected $bdd;

    public function __construct() {
        $this->bdd = Connexion::getBdd();
    }

    public function insererFeedback($idUtilisateur, $nomUtilisateur, $email, $commentaire) {
        // La requête SQL inclut maintenant l'id_utilisateur
        $requete = $this->bdd->prepare("INSERT INTO Feedback (id_utilisateur, nom_utilisateur, email, commentaire) VALUES (?, ?, ?, ?)");
        
        // Exécution de la requête avec l'id_utilisateur et les autres données
        $requete->execute([$idUtilisateur, $nomUtilisateur, $email, $commentaire]);
    }

    public function recupererFeedbacks() {
        $requete = $this->bdd->query("SELECT * FROM Feedback");
        return $requete->fetchAll();
    }


}

?>
