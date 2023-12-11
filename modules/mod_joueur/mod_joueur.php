<?php

require_once("cont_joueur.php");

class ModJoueur
{

    private $action, $cont;

    public function __construct()
    {
        $this->cont = new ContJoueur;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "score";
    }

    public function exec()
    {

        $this->cont->afficheMenu();

        switch ($this->action) {

            case "score":
                $this->cont->afficheClass();
                break;

            case "vague":
                $this->cont->afficheClass();
                break;
            default:
                die("L'action n'existe pas.");
        }
    }

}


?>