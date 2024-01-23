<?php
require_once 'modele_feedback.php';
require_once 'vue_feedback.php';

class ContFeedback {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleFeedback();
        $this->vue = new VueFeedback();
    }

    public function soumettreFeedback() {
        $this->modele->insererFeedback();
        echo "Le feedback a été envoyer.";
    }

    public function afficher_form() {
        $pseudo = $this->modele->getPseudo();
        $this->vue->afficherFormulaire($pseudo);
    }
}
?>
