<?php

require_once("modele_joueur.php");
require_once("vue_joueur.php");

class ContJoueur {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleJoueur;
        $this->vue = new VueJoueur;
    }

    public function affiche_stat() {
        $statMoyenne = $this->modele->getStatJoueur("avg");
        $statMax = $this->modele->getStatJoueur("max");
        $statMin = $this->modele->getStatJoueur("min");
        $this->vue->affiche_stat($statMoyenne,$statMax,$statMin);
    }

}

?>