<?php

require_once("cont_admin.php");

class ModAdmin {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContJoueur;
        $this->action = isset($_GET['action']) ? $_GET['action'] : ""; 
    }

    public function exec() {

        switch($this->action) {
            default:
                die("l'action n'existe pas.");
        }
    }

}

?>