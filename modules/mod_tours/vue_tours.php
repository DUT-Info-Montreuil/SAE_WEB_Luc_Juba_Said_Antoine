<?php
// Ce fichier s'occupera de l'affichage des données.
include_once("vue_generique.php");
class VueTours extends VueGenerique{

    public function __construct(){
        parent::__construct();
    }

    public function afficherTours($tours) {

        
    }

    public function afficherBarre(){
        ?>
         <form action="" method="get">
         <input type="text" name="search" placeholder="Rechercher un tour par nom...">
         <button type="submit">Rechercher</button>
         </form>
        <?php
        
    }
   

}
?>



