<?php

require_once("cont_partie.php");

class ModPartie {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContPartie;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "affiche"; 
    }

    public function exec() {

        switch($this->action) {
            case "affiche":
                $this->cont->affiche_historique();
            break;
            case "details":
                $this->cont->affiche_partieDetails();
            break;
            case "listeHebdo":
                $this->cont->affiche_historiqueHedbo();
            break;
            case "listeJournalier":
                $this->cont->affiche_historiqueJournalier();
            break;
            case "listeMensuelle":
                $this->cont->affiche_historiqueMensuelle();
            break;
            default:
                die("l'action n'existe pas.");
        }
    }
    
}

?>