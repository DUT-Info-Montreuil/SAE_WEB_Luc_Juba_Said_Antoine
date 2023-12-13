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
            echo '<div class="row">'; // Utilisation de la classe 'row' pour aligner les images en ligne
        foreach ($elements as $element) {
                $imageUrl = htmlspecialchars($element['image']);
                $elementId = htmlspecialchars($element['id_acteurs']);
                ?>
                <div class="col-md-4 col-lg-3 col-sm-6"> <!-- Ajustez les classes de grille selon le besoin -->
                    <a href="index.php?module=mod_acteur&action=details&id=<?php echo $elementId; ?>">
                        <img src="<?php echo $imageUrl; ?>" alt="Image de l'élément" class="img-fluid" style="width:100%; height:auto; margin-bottom: 20px;"> <!-- 'img-fluid' pour rendre l'image responsive -->
                    </a>
                </div>
                <?php
            }
            echo '</div>';
        }
    }
    
    
    public function affiche($acteur){
        ?>
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
        <p><?php echo $acteur['nom'];?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
        <?php
}



   
public function affiche_details_acteur($acteur)
{
    ?>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="card" style="width: 18rem;">
            <img src="<?php echo htmlspecialchars($acteur['image']); ?>" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">Détails de <?php echo htmlspecialchars($acteur['nom']); ?></h5>
                <p class="card-text">Id: <?php echo htmlspecialchars($acteur['id_acteurs']); ?></p>
                <p class="card-text">Nom: <?php echo htmlspecialchars($acteur['nom']); ?></p>
                <p class="card-text">Attaque: <?php echo htmlspecialchars($acteur['attaque']); ?></p>
                <p class="card-text">Descriptif: <?php echo htmlspecialchars($acteur['descriptif']); ?></p>
                <a href="index.php?module=mod_acteur&action=liste" class="btn btn-primary">Allez vers liste d'acteur</a>
            </div>
        </div>
    </div>
    <?php
}


public function affichage_searche_bar(){

}

    

    






}
?>




    