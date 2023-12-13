<?php
require_once "modele_acteur.php";
require_once "vue_acteur.php";
class ContActeur {
    private $modele_acteur;
    private $vue_acteur;

    public function __construct() {
        $this->modele_acteur = new ModeleActeur();
        $this->vue_acteur = new VueActeur();
    }
    public function liste() {
        $liste = $this->modele_acteur->getListe();
        $this->vue_acteur->affiche_liste($liste);
    }
    public function details(){
        if(isset($_GET['id'])){
            $res = $this->modele_acteur->detail($_GET['id']);
            $this->vue_acteur->affiche_details_acteur($res);
        }else{
            echo "id n'exite pas ";
        }
       

    }



}


?>