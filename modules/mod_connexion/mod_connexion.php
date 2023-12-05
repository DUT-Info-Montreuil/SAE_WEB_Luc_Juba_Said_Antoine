<?php

require_once("cont_connexion.php");

class ModConnexion {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContConnexion;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "form_connexion"; 
    }

    public function exec() {

        switch($this->action) {
            case "form_connexion":
                $this->cont->get_formConnexion();
            break;
            case "form_inscription":
                $this->cont->get_formInscrire();
            break;
            case "inscrire": 
                $this->cont->inscrireUtilisateur();
            break;
            case "connexion":
                $this->cont->connexionUtilisateur();
            break;
            case "deconnexion":
                $this->cont->deconnexion();
            break;
            default :
                die("L'action n'existe pas.");
        }
    }
    
}

?>