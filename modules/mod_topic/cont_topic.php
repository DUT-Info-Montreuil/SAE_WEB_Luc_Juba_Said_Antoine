<?php

require_once("modele_topic.php");
require_once("vue_topic.php");

class ContTopic {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleTopic;
        $this->vue = new VueTopic;
    }

    public function afficheForm() {
        $this->vue->afficheFormTopic();
    }

    public function creerTopic() {
        $this->modele->insertTopic();
    }
    
}

?>