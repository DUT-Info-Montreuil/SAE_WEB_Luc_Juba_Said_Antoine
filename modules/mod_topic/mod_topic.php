<?php

require_once("cont_topic.php");

class ModTopic {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContTopic;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "default"; 
    }

    public function exec() {

        switch($this->action) {
            case 'default':
                $this->cont->afficheForm();
            break;
            case 'creerTopic':
                $this->cont->creerTopic();
            break;
            default:
                die("l'action n'existe pas.");
        }
    }

}

?>