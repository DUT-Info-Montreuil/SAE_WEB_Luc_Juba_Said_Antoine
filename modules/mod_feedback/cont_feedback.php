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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modele->insererFeedback();
        }
        $this->vue->afficherFormulaire();
    }
}
?>
