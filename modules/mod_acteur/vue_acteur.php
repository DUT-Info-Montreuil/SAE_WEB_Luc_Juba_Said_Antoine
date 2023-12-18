<?php
require_once "vue_generique.php";

class VueActeur extends vueGenerique{
    private $pageActuelle;
    
    public function __construct()
    {
        $this->pageActuelle=isset($_GET['page']) ? (int)$_GET['page'] : 1;
       
        parent::__construct();
    }
    public function affiche_liste($elements){
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
                        <img src="<?php echo $imageUrl; ?>" alt="Image de l'élément" class="img-fluid" style="width:75%; height:auto; margin-bottom: 20px;"> <!-- 'img-fluid' pour rendre l'image responsive -->
                    </a>
                </div>
                <?php
            }
            echo '</div>';
        }
    }



   
public function affiche_details_acteur($acteur)
{
    ?>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="card" style="width: 100%; max-width: 1000px; margin: auto; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
            <img src="<?php echo htmlspecialchars($acteur['image']); ?>" class="card-img-top" alt="" style="width: 100%; height: auto; object-fit: cover;"> <!-- Ajustement du style de l'image -->
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



public function affichage_les_pages_suivant($nombreTotalDePages) {
    
    $pageActuelle = $this->pageActuelle;
    $pagePrecedente = max(1, $pageActuelle - 1);
    $pageSuivante = min($nombreTotalDePages, $pageActuelle + 1);
    ?>
    <nav aria-label="Page navigation example" style="display: flex; justify-content: center;">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="index.php?module=mod_acteur&action=liste&page=<?php echo $pagePrecedente; ?>">Avant</a>
            </li>
            <?php for ($i = 1; $i <= $nombreTotalDePages; $i++): ?>
                <li class="page-item <?php echo $i === $pageActuelle ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?module=mod_acteur&action=liste&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="index.php?module=mod_acteur&action=liste&page=<?php echo $pageSuivante; ?>">Suivant</a>
            </li>
        </ul>
    </nav>
    <?php
}





}
?>




    