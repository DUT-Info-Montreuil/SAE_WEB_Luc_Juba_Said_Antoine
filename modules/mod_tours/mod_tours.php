<?php

require_once("cont_connexion.php");

class ModTours {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContConnexion;
        $this->action = isset($_GET['action']) ? $_GET['action'] : ""; 
    }

    public function exec() {

      switch($action){
        default : 
        die("Action inexistante");
      }
    }
    
}

?>