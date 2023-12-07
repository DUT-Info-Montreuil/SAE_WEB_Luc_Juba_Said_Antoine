<?php

require_once("cont_joueur.php");

class ModJoueur {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContJoueur;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "test"; 
    }

    public function exec() {
        
        switch($this->action) {
            case "test":
                $this->cont->afficheClass();
            break;
            default :
                die("L'action n'existe pas.");
        }
    }
    
}


?>