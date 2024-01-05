<?php

// modele_feedback.php

require_once 'mod_feedback.php';

class ModeleFeedback {
    private $modFeedback;

    public function __construct() {
        $this->modFeedback = new ModFeedback();
    }

    public function soumettreFeedback($nomUtilisateur, $email, $commentaire) {
        $this->modFeedback->insererFeedback($nomUtilisateur, $email, $commentaire);
    }

    public function obtenirFeedbacks() {
        return $this->modFeedback->recupererFeedbacks();
    }
}


?>