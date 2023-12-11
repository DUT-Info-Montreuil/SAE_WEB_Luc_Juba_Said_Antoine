<?php
require_once "vue_generique.php";
class VueActeur extends vueGenerique{
    public function __construct()
    {
        parent::__construct();
    }

    public function affiche_liste($elements) {
        if (empty($elements)) {
            echo "<p>Aucun élément à afficher</p>";
        } else {
            echo '<div class="row">'; // Début de la rangée Bootstrap
    
            foreach ($elements as $element) {
                $imageUrl = htmlspecialchars($element['image']);
                $elementId = htmlspecialchars($element['id_acteurs']); 
    
                // Affiche l'image dans une colonne Bootstrap
                echo '<div class="col">';
                echo '<a href="index.php?module=mod_acteur&action=details&id=' . $elementId . '">';
                echo '<img src="' . $imageUrl . '" alt="Image de l\'élément" class="img-fluid">'; // 'img-fluid' pour rendre l'image responsive
                echo '</a>';
                echo '</div>';
            }
    
            echo '</div>';
        }
    }
    
    


    public function affiche_details_joueur($acteur)
    {
        echo "<h2>Détails du Acteur :</h2>";
        if (empty($acteur)) {
            echo "<p>Aucun détail à afficher</p>";
        } else {
            echo "<p>ID : " . $acteur['id_acteurs'] . "</p>";
            echo "<p>Nom : " . $acteur['nom'] . "</p>";
            echo "<p>pv : " . $acteur['pv'] . "</p>";
            echo "<p>attaque : " . $acteur['attaque'] . "</p>";
            echo "<p>descriptif : " . $acteur['descriptif'] . "</p>";
            //echo "<p>Logo : <img src='" . $acteur['image'] . "' alt='Logo de " . $acteur['image'] . "' style='max-width:100px;max-height:100px;'></p>";
        }
    }

}
?>



    