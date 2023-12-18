<?php
require_once "modele_acteur.php";
require_once "vue_acteur.php";





class ContActeur {
    private $modele_acteur;
    private $vue_acteur;
    private $pageActuelle;
    private $acteursParPage;

    public function __construct() {
        $this->modele_acteur = new ModeleActeur();
        $this->vue_acteur = new VueActeur();
        $this->pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $this->acteursParPage = 8;
    }

    public function liste() {
        $liste = $this->modele_acteur->getListe($this->pageActuelle, $this->acteursParPage);
        $this->vue_acteur->affiche_liste($liste);
    }

    public function details() {
        if (isset($_GET['id'])) {
            $res = $this->modele_acteur->detail($_GET['id']);
            $this->vue_acteur->affiche_details_acteur($res);
        } else {
            echo "id n'existe pas";
        }
    }

    public function affichage_les_pages($pagTotal) {
        $this->vue_acteur->affichage_les_pages_suivant($pagTotal);
    }
}



?>