<?php

require_once("modele_partie.php");
require_once("vue_partie.php");

class ContPartie {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModelePartie;
        $this->vue = new VuePartie;
    }

    public function affiche_historique() {
        $tab = $this->modele->getListePartie();
        $this->vue->affiche_partie($tab);
    }
}

?>