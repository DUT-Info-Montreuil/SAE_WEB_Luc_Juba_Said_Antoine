<?php

require_once("modele_admin.php");
require_once("vue_admin.php");

class ContAdmin {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleAdmin;
        $this->vue = new VueAdmin;
    }

}

?>