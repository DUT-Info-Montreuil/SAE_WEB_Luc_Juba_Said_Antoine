<?php

require_once("cont_feedback.php");

class ModFeedback {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContFeedback;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "form_feedback"; 
    }

    public function exec() {

        switch($this->action) {
            case 'form_feedback':
                $this->cont->afficher_form();
            break;
            case 'inserer':
                $this->cont->soumettreFeedback();
            break;
            default :
                die("L'action n'existe pas.");
        }
    }
    
}

?>