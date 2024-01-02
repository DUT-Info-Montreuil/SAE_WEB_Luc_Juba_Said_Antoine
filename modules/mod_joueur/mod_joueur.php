<?php

require_once("cont_joueur.php");

class ModJoueur {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContPartie;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "default"; 
    }

    public function exec() {

        switch($this->action) {
            default:
                die("l'action n'existe pas.");
        }
    }
    
}

?>