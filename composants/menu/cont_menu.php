<?php 

include_once('vue_menu.php');

class ContMenu {

    private $vue;

    public function __construct() {
        $this->vue = new VueMenu;
    }

    public function getContent() {
        return $this->vue->contenu;
    }
}

?>