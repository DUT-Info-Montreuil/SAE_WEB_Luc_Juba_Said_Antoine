<?php

require_once("modele_joueur.php");
require_once("vue_joueur.php");

class ContJoueur {


    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleJoueur;
        $this->vue = new VueJoueur;
    }
    public function afficheMenu()
    {
        $this->vue->filtreClassement();
    }

    public function afficheClass(){
        $joueurs = $this->modele->getClassementJoueur($_GET['action']);
        $this->vue->afficheClassement($joueurs);
    }

}