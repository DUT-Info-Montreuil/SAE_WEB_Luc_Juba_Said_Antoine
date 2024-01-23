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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Partie
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?module=partie">Historique</a></li>
                            </ul>
                        </li>
                        <a class="nav-link" href="index.php?module=joueur">Joueur</a> 
                        <a class="nav-link" href="index.php?module=joueur&action=classement">Classement</a> 
                        <a class="nav-link" href="index.php?module=joueur&action=profile">Profile</a> 
                        <a class="nav-link" href="index.php?module=mod_acteur">Liste Acteurs</a>
                        <a class="nav-link" href="index.php?module=tours">Liste Tours</a>
                        <a class="nav-link" href="index.php?module=succes&action=pagePrincipal">Succès</a> 
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
                        <a class="nav-link" href="index.php?module=mod_acteur">Liste Acteurs</a>
                        <a class="nav-link" href="index.php?module=tours">Liste Tours</a>
                    </div>
                </div>
                </div>
            </nav>';
        }
    }
}