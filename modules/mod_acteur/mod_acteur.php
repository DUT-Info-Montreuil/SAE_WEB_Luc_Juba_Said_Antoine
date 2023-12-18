<?php
require_once "cont_acteur.php";
class ModActeur{
    private $conts_acteur;
    private $modele_acteur;
    private $action;
    private $vue_acteur;
    private $pageTotale;
    public function __construct(){
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'liste';
        $this->conts_acteur=new ContActeur();
        $this->modele_acteur=new ModeleActeur();
        $this->vue_acteur=new VueActeur();
        $this->pageTotale = ceil($this->modele_acteur->getNombreTotalActeurs() / 8);//arroundi 


        
        switch ($this->action) {
            case 'liste':
                $this->conts_acteur->liste();
                $this->conts_acteur->affichage_les_pages($this->pageTotale); // Ajout de l'appel de la pagination
                break;
            case 'details':
                $this->conts_acteur->details();
                // Pas de pagination nécessaire pour les détails
                break;

            
        }
    }

}


?>