<?php

require_once("modele_connexion.php");
require_once("vue_connexion.php");

class ContConnexion {

    private $modele,$vue;

    public function __construct(){
        $this->modele = new ModeleConnexion;
        $this->vue = new VueConnexion;
    }

    public function get_formInscrire() {
        $this->vue->form_inscrire();
    }

    public function get_formConnexion() {
        if(isset($_SESSION['login'])) {
           $this->vue->deja_connecter();
        }else {
            $this->vue->form_connexion();
        }
    }

    public function inscrireUtilisateur() {
        if($this->modele->verifUtilisateurs()) {
            $inscrire = $this->modele->inscrire();
            if($inscrire) {
                $this->vue->inscription_valide();
            }else {
                $this->vue->erreur_champs();
            }
        }else {
           $this->vue->compte_existant();
        }
    }

    public function connexionUtilisateur() {
        if(!isset($_SESSION['login'])) {
            if($this->modele->connexion()) {
                $res = $this->modele->connexion();
                $_SESSION['login'] = array('id_u' => $res['id_utilisateur'],'id_r' => $res['id_role']);
                $this->vue->connexion_valide();
            }else {
                $this->vue->erreur_champs();
            }
        }else {
            $this->vue->deja_connecter();
        }
    }

    public function deconnexion() {
        unset($_SESSION['login']);
        $this->vue->deconnexion_valide();
    }
}

?>