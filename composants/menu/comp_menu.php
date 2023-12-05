<?php

include_once('cont_menu.php');

class CompMenu {

    private $cont;

    public function __construct() {
        $this->cont = new ContMenu;
    }

    public function affichage() {
        echo $this->cont->getContent();
    }
}