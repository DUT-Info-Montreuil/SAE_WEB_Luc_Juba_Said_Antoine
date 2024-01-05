<?php

require_once("modele_joueur.php");
require_once("vue_joueur.php");

class ContJoueur {


    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleJoueur;
        $this->vue = new VueJoueur;
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

    
    public function modifierProfile(){
        $this->modele->modificationMotDePasse();
    }

    public function afficheProfil(){
        $joueur = $this->modele->getInfoProfil();
        $this->vue->profil($joueur);
    }

    


}