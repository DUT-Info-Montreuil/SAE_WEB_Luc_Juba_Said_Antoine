<?php
session_start();

include_once "connexion.php";

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
    case 'mod_acteur':
        include_once('modules/mod_acteur/mod_acteur.php');
        $mod_acteur=new ModActeur();
    break;
    case 'tours':
        include_once('modules/mod_tours/mod_tours.php');
            $contTours = new ModTours();
            $contTours->exec();
    break;
    case 'succes':
        include_once('modules/mod_succes/mod_succes.php');
            $contSucces = new ModSucces();
            $contSucces->exec();
    break;
    case 'partie':
        include_once('modules/mod_partie/mod_partie.php');
        $modPartie = new ModPartie;
        $modPartie->exec();
    break;
    case 'joueur':
        include_once('modules/mod_joueur/mod_joueur.php');
        $modJoueurs = new ModJoueur;
        $modJoueurs->exec();
    break;
    case 'admin':
        if(isset($_SESSION['login']) && $_SESSION['login']['id_r'] == 2 ){
            include_once('modules/mod_admin/mod_admin.php');
            $modAdmin = new ModAdmin;
            $modAdmin->exec();
        }else {
            die("vous n'etes pas administrateur.");
        }
    break;
    case 'feedback':
        include_once('modules/mod_feedback/cont_feedback.php');
        $modFeedback = new ModFeedback();
        $modFeedback->exec();
    break;
    default:
       die("Le module n'existe pas.");
}

$contenu = $vueGen->getAffichage();

include_once("composants/menu/comp_menu.php");

$compMenu = new CompMenu;

include_once('template.php');



?>