<?php

require_once("cont_admin.php");

class ModAdmin {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContAdmin;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "default"; 
    }

    public function exec() {

        switch($this->action) {
            case 'default':
                $this->cont->affiche();
            break;
            case 'supprimer':
                $this->cont->suppUtilisateur();
            break;
            case 'getUtilisateurs':
                $this->cont->getUtilisateurs();
            break;
            case 'rechercher':
                $this->cont->resultatRecherche();
            break;
            case 'affichageFeedback':
                $this->cont->afficherFeedbackCont();
                break;
            default:
                die("l'action n'existe pas.");
        }
    }

}

?>