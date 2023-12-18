<?php

session_start();

include_once('connexion.php');

$con = new Connexion();
$con::init_Connexion();

include_once('vue_generique.php');

$vueGen = new VueGenerique;

$module = isset($_GET['module']) ? htmlspecialchars($_GET['module']) : "connexion"; 

switch($module) {
    case 'connexion':
        include_once('modules/mod_connexion/mod_connexion.php');
        $modConnexion = new ModConnexion;
        $modConnexion->exec();
    break;
    case 'joueur':
        include_once('modules/mod_joueur/mod_joueur.php');
        $modJoueur = new ModJoueur;
        $modJoueur->exec();
    break;

    default:
       die("Le module n'existe pas.");
}

$contenu = $vueGen->getAffichage();

include_once("composants/menu/comp_menu.php");

$compMenu = new CompMenu;

include_once('template.php');

?>