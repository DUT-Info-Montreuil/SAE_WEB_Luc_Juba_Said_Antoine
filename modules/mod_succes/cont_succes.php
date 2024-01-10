<?php
require_once "modele_succes.php";
require_once "vue_succes.php";
class ContSucces{
    private $modele_sucess;
    private $vue_sucess;

    public function __construct() {
        $this->modele_sucess = new ModeleSucces();
        $this->vue_sucess = new VueSucces();

    }
    public function affichage_page_principale() {
            $this->vue_sucess->affiche_la_page_succes();
    }

}