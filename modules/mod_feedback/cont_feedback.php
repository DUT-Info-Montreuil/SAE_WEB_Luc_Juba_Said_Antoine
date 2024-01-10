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
       // session_start(); // Assurez-vous que la session est démarrée

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération de l'id_utilisateur depuis la session
            $idUtilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;


            if ($idUtilisateur&&($_GET['action'] == 'inserer' && $_SERVER['REQUEST_METHOD'] === 'POST')) {
                // Appel de la méthode soumettreFeedback avec les données POST
                $this->modele->soumettreFeedback($idUtilisateur, $_POST['nom_utilisateur'], $_POST['email'], $_POST['commentaire']);
            }
        }

        $feedbacks = $this->modele->obtenirFeedbacks();
        $vue = new VueFeedback();
        $vue->afficherFeedbacks($feedbacks);
        $vue->afficherFormulaire();
    }
}

?>
