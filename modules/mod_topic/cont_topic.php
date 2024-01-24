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
        if($this->modele->insertTopic()) {
            echo "Insertion réussite.";
        }else {
            echo "Une erreur inattendu est survenu !";
        }
    }

    public function affiche_liste_topic() {
        $tab = $this->modele->getAllTopic();
        $this->vue->afficheListeTopic($tab,$this->modele);
    }

    public function affiche_topic() {
        $this->vue->affiche_topic($this->modele->getTopic(),$this->modele->getAllMessageByTopic());
    }

    public function insertCom() {
        if($this->modele->insererCommentaire()) {
            echo "True";
        }else {
            echo "False";
        }
    }
    
}

?>