<?php
require_once "vue_generique.php";
class VueActeur extends vueGenerique{
    public function __construct()
    {
        parent::__construct();
    }

    public function affiche_liste($elements){
    if (empty($elements)) {
        echo "<p>Aucun élément à afficher</p>";
    } else {
        foreach ($elements as $element) {
            echo "<br>";
            // Affiche le nom du joueur comme un lien vers les détails du joueur
            echo '<a href="index.php?module=mod_acteur&action=details&id=' . $element['id_acteurs'] . '">' . $element['nom'] . '</a>';
        }
        echo "<br>";
    }
}


    public function menu(){
        echo '<div class="menu">';
        echo '<a href="index.php?module=mod_acteur&action=liste">Liste les acteurs</a>';
        echo '</div>';
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
            //echo "<p>image : " . $acteur['image'] . "</p>";
        }
    }

}
?>



    