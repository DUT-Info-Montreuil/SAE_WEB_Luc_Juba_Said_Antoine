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
        if(!empty($tab)) {
            $this->vue->affiche_partie($tab);
        }else {
            $this->vue->aucune_partie();
        }
    }

    public function affiche_historiqueJournalier() {
        $tab = $this->modele->getListePartieJournalier();
        $this->vue->affiche_partie($tab);
    }

    public function affiche_historiqueHedbo() {
        $tab = $this->modele->getListePartieHebdomadaire();
        $this->vue->affiche_partie($tab);
    }

    public function affiche_historiqueMensuelle() {
        $tab = $this->modele->getListePartieMensuelle();
        $this->vue->affiche_partie($tab);
    }

    public function affiche_partieDetails() {
        $partie = $this->modele->getPartie($_GET['id']);
        $this->vue->affiche_details($partie);
    }
}

?>