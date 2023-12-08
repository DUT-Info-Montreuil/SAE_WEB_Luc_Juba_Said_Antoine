<?php

class VueMenu {

    public $contenu; 

    public function __construct() {
        if(isset($_SESSION['login'])) {
            $this->contenu = '
            <nav class="navbar border-bottom border-body navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                <a class="navbar-brand" href="index.php"> Tower defense </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav style="width: 100%;">
                        <a class="nav-link" href="index.php?module=classement">Classement</a> 
                        <a class="nav-link" href="index.php?module=connexion&action=deconnexion">Déconnexion</a> 
                    </div>
                </div>
                </div>
            </nav>';
        } else {
            $this->contenu = '
            <nav class="navbar bg-primary border-bottom border-body navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Tower defense</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" style="width: 100%;">
                        <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        <a class="nav-link" href="index.php?module=connexion">Connexion</a>
                        <a class="nav-link" href="index.php?module=connexion&action=form_inscription">Inscription</a>
                    </div>
                </div>
                </div>
            </nav>';
        }
    }
}