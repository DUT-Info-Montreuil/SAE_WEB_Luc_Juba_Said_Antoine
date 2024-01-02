<?php

require_once("modele_joueur.php");
require_once("vue_joueur.php");

class ContPartie {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleJoueur;
        $this->vue = new VueJoueur;
    }
    
}

?>