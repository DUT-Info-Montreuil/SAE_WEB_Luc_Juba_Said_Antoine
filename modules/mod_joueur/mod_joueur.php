<?php

require_once("cont_joueur.php");

class ModJoueur
{

    private $action, $cont;

    public function __construct()
    {
        $this->cont = new ContJoueur;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "classement";
    }

    public function exec()
    {

        switch ($this->action) {

            case "classement":
            case "score":
            case "vague":
                $this->cont->afficheMenu();
                $this->cont->affiche3Class();
                break;

            case "affichePlusClassement" :
                $this->cont->afficheMenu();
                $this->cont->afficheClass();
                break;

            case "sauvegarde":
                $this->cont->modifierProfile();
                break;

            case "profile":
                $this->cont->afficheProfil();
                break;

            default:
                die("L'action n'existe pas.");
        }
    }

}


?>