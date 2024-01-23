<?php
require_once "cont_succes.php";

class ModSucces{
    private $conts_succes;
    private $modele_succes;
    private $action;
    private $vue_succes;
    public function __construct() {
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'pagePrincipal';
        $this->conts_succes=new ContSucces();
        $this->modele_succes=new ModeleSucces();
        $this->vue_succes=new VueSucces();
    }
    public function exec() {
        switch ($this->action){
            case 'pagePrincipal':
            $this->conts_succes->affichage_page_principale_conts();
            break;
        }
    }


}