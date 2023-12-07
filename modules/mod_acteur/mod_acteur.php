<?php
require_once "cont_acteur.php";
class ModActeur{
    private $conts_acteur;
    private $modele_acteur;
    private $action;
    private $vue_acteur;
    public function __construct(){
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'liste';
        $this->conts_acteur=new ContActeur();
        $this->modele_acteur=new ModeleActeur();
        $this->vue_acteur=new VueActeur();
        switch ($this->action) {
            case 'liste':
                $this->conts_acteur->liste();
                break;
            case 'details':
                    if (isset($_GET['id'])) {
                        $id_acteur = $_GET['id'];
                        $details_acteur = $this->modele_acteur->detail($id_acteur);
                        $this->vue_acteur->affiche_details_joueur($details_acteur);
                    } else {
                        echo "ID du joueur n'est pas passé dans pramettre.";
                    }
                break;
            default:
                    echo " <br>Rien n'est passé dans variable action";
                break;

            
        }
    }

}


?>