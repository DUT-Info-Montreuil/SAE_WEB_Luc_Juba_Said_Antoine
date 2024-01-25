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
        $tab = $this->modele->getUtilisateurs();
        $data = array(
            'nbrInscrit' => $this->modele->getNombreCompte(),
            'meilleurJoueur' => $this->modele->getMeilleurJoueur(),
            'nbrPartie' => $this->modele->getNombrePartie(),
            'nbrFeedback' => $this->modele->getNombreFeedback()
        );
        $this->vue->affiche_Tableau_de_Bord($tab,$data);
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

    public function getUtilisateurs() {
        $users = $this->modele->getUtilisateurs();
        $vue = new VueAdmin;
        $data = array(
            'nbrInscrit' => $this->modele->getNombreCompte(),
            'meilleurJoueur' => $this->modele->getMeilleurJoueur(),
            'nbrPartie' => $this->modele->getNombrePartie(),
            'nbrFeedback' => $this->modele->getNombreFeedback()
        );
        echo $vue->affiche_utilisateur($users,$data);
        exit();
    }

    public function resultatRecherche() {
        $users = $this->modele->rechercherUtilisateur();
        $vue = new VueAdmin;
        echo $vue->affiche_utilisateur($users);
        exit();
    }

    public function afficherFeedbackCont(){
         $resl = $this->modele->recupererFeedback_modele();
         //var_dump($resl);
         $this->vue->afficherFeedbacks($resl);
    }
    
}

?>