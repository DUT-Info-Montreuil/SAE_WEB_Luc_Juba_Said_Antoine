<?php
// Ce fichier s'occupera de l'affichage des données.
include_once("vue_generique.php");
class VueTours extends VueGenerique{

    public function __construct(){
        parent::__construct();
    }

    

    public function afficherTours($elements){
        if (empty($elements)) {
            echo "<p>Aucun élément à afficher</p>";
        } else {
            foreach ($elements as $element) {
                echo "<br>";
                // Affiche le nom du joueur comme un lien vers les détails du joueur
                echo '<a href="index.php?module=mod_tours&action=details&id=' . $element['id_tour'] . '">' . $element['nom'] . '</a>';
            }
            echo "<br>";
        }
    }

    public function afficherBarre(){
        ?>
         <div class="mx-auto p-2">
         <form action="" method="get">
         <input type="text" name="search" placeholder="Rechercher un tour par nom...">
         <button type="submit">Rechercher</button>
         </form>
        </div>
     
        <?php
        
    }
   

}
?>



