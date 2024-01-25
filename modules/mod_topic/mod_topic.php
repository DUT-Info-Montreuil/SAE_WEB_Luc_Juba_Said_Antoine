<?php

require_once("cont_topic.php");

class ModTopic {

    private $action,$cont;

    public function __construct(){
        $this->cont = new ContTopic;
        $this->action = isset($_GET['action']) ? $_GET['action'] : "affiche_topic"; 
    }

    public function exec() {

        switch($this->action) {
            case 'affiche_topic': 
                $this->cont->affiche_liste_topic();
            break;
            case 'affiche_form':
                $this->cont->afficheForm();
            break;
            case 'creerTopic':
                $this->cont->creerTopic();
            break;
            case 'topic':
                $this->cont->affiche_topic();
            break;
            case 'insertCom':
                $this->cont->insertCom();
            break;
            case 'supprimerCom':
                $this->cont->suppCommentaire();
            break;
            default:
                die("l'action n'existe pas.");
        }
    }

}

?>