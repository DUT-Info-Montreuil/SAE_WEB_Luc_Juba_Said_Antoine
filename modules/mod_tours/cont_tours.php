<?php
require "modele_tours.php";
require "vue_tours.php";

class ContTours {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleTours();
        $this->vue = new VueTours();
    }

    public function afficheTours() {
        $this->vue->afficherBarre();
        $tours = $this->modele->getTours();
        $this->vue->afficherTours($tours);
    }

    public function rechercheTours() {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $nom = $_GET['search'];
            $tours = $this->modele->rechercheTours($nom);
        } else {
            $tours = $this->modele->getTours();
        }
        $this->vue->afficherTours($tours);
    }
    
}
?>
