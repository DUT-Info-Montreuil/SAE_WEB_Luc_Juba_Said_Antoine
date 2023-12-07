<?php

require_once("modele_joueur.php");
require_once("vue_joueur.php");

class ContJoueur {


    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleJoueur;
        $this->vue = new VueJoueur;
    }


    public function afficheClass(){
        $joueurs = $this->modele->getClassementJoueurParScore();
        $this->vue->afficheClassement($joueurs);
    }

}