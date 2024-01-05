<?php
// mod_feedback.php

require_once 'connexion.php';

class ModFeedback {
    protected $bdd;

    public function __construct() {
        $this->bdd = Connexion::getBdd();
    }

    public function insererFeedback($nomUtilisateur, $email, $commentaire) {
        $requete = $this->bdd->prepare("INSERT INTO feedbacks (nom_utilisateur, email, commentaire) VALUES (?, ?, ?)");
        $requete->execute([$nomUtilisateur, $email, $commentaire]);
    }

    public function recupererFeedbacks() {
        $requete = $this->bdd->query("SELECT * FROM Feedback");
        return $requete->fetchAll();
    }
}


?>