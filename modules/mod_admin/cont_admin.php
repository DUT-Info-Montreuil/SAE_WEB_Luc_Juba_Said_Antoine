<?php

require_once("modele_admin.php");
require_once("vue_admin.php");

class ContAdmin {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleAdmin;
        $this->vue = new VueAdmin;
    }

    public function affiche() {
        $tab = $this->modele->getAllUser();
        $this->vue->affiche_Tableau_de_Bord($tab);
    }

    public function suppUtilisateur() {
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;

        $rowCount = $this->modele->deleteUtilisateur($id);

        if ($rowCount > 0) {
            header('Content-Type: application/json');
            echo json_encode(["success" => true, "message" => "Utilisateur supprimé avec succès"]);
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Erreur lors de la suppression de l'utilisateur"]);
            exit();
        }
    }
    
}

?>