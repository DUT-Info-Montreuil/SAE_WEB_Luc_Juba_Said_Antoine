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
        $tours = $this->modele->getTours();
        $this->vue->afficherTours($tours);
    }
}
?>
