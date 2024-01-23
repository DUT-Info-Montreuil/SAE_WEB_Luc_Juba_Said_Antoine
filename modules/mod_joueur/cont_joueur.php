<?php

require_once("modele_joueur.php");
require_once("vue_joueur.php");

class ContJoueur {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleJoueur;
        $this->vue = new VueJoueur;
    }

    public function affiche_stat() {
        $statMoyenne = $this->modele->getStatJoueur("avg");
        $statMax = $this->modele->getStatJoueur("max");
        $statMin = $this->modele->getStatJoueur("min");
    
        if (!empty(array_filter($statMoyenne)) || !empty(array_filter($statMax)) || !empty(array_filter($statMin))) {
            $this->vue->affiche_stat($statMoyenne, $statMax, $statMin);
        } else {
            $this->vue->affiche_sans_stat();
        }
    }

    public function moyenne() {
    
        $statGlobale = $this->modele->getStatMoyenneGlobale();
        $statJoueur = $this->modele->getStatMoyenneJoueur();
    
        $data = [
            'statGlobale' => $statGlobale,
            'statJoueur' => $statJoueur
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
      
    public function afficheMenu()
    {
        $this->vue->filtreClassement();
    }

    public function affiche3Class(){
        $joueurs = $this->modele->getDesClassementJoueur($_GET['action']);
        $this->vue->affiche3Classement($joueurs);
    }

    public function afficheClass(){
       $joueurs = $this->modele->getDesClassementJoueur($_GET['action']);
       $this->vue->afficheClassement($joueurs);
    }


    public function afficheProfil(){
        $joueur = $this->modele->getInfoProfil();
        $this->vue->profil($joueur);
    }


}