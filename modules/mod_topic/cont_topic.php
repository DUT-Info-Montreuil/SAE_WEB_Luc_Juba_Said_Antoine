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
        header('Content-Type: application/json');
        if ($this->modele->insererCommentaire()) {
            echo json_encode(array('success' => true));
            exit();
        } else {
            echo json_encode(array('success' => false, 'message' => 'Erreur lors de l\'insertion du commentaire.'));
            exit();
        }
    }

    public function suppCommentaire() {
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;

        $rowCount = $this->modele->deleteCommentaire($id);

        if ($rowCount > 0) {
            header('Content-Type: application/json');
            echo json_encode(["success" => true, "message" => "Commentaire supprimé avec succès"]);
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Erreur lors de la suppression de commentaire"]);
            exit();
        }
    }

}

?>