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
        }
    }
    
}

?>