<?php
// cont_feedback.php

require_once 'modele_feedback.php';
require_once 'vue_feedback.php';

class ContFeedback {
    private $modele;

    public function __construct() {
        $this->modele = new ModeleFeedback();
    }

    public function exec() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement du formulaire de feedback
            $this->modele->soumettreFeedback($_POST['nom_utilisateur'], $_POST['email'], $_POST['commentaire']);
        }

        $feedbacks = $this->modele->obtenirFeedbacks();
        $vue = new VueFeedback();
        $vue->afficherFeedbacks($feedbacks);
        $vue->afficherFormulaire();
    }
}



?>