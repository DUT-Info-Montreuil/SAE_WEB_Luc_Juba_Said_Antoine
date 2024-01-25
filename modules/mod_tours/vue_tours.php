<?php
// Ce fichier s'occupera de l'affichage des données.
include_once "vue_generique.php";

class VueTours extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function afficherTours($elements)
    {
        ?>
        <div class="container mt-5">
            <?php if (empty($elements)) : ?>
                <p>Aucun élément à afficher</p>
            <?php else : ?>
                <div class="row">
                    <?php foreach ($elements as $element) : ?>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <!-- Lien autour de l'image pour ouvrir le popup -->
                                <a href="#popup<?= htmlspecialchars($element['id_tour']) ?>">
                                    <img src="<?= htmlspecialchars($element['image']) ?>" class="card-img-top" alt="Image du tour" style="cursor:pointer;">
                                </a>
    
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($element['nom']) ?></h5>
                                    <p class="card-text">Dégâts: <?= htmlspecialchars($element['degat']) ?></p>
                                </div>
                            </div>
                        </div>
    
                        <!-- Popup basé sur CSS -->
                        <div id="popup<?= htmlspecialchars($element['id_tour']) ?>" class="popup">
                            <div class="popup-content">
                                <a href="#" class="close">&times;</a>
                                <p>Nom: <?= htmlspecialchars($element['nom']) ?></p>
                                <p>Dégâts: <?= htmlspecialchars($element['degat']) ?></p>
                                <p>Prix: <?= isset($element['prix']) ? htmlspecialchars($element['prix']) : 'Non spécifié' ?></p>
                                <p>Description: <?= isset($element['description']) ? htmlspecialchars($element['description']) : 'Non spécifiée' ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
    



    public function afficherBarre()
    {
        ?>
        <div class="search-bar">
            <form action="index.php?module=tours&action=recherche" method="post">
                <input type="text" name="search" placeholder="Rechercher un tour par nom...">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <?php
    }

    public function afficherDetailsTour($tour)
    {
        if (isset($tour) && is_array($tour)) {
            ?>
            <div class="details-tour">
                <?php if (isset($tour['image'])): ?>
                    <img src="<?= htmlspecialchars($tour['image']) ?>" alt="Image de la tour">
                <?php endif; ?>

                <?php if (isset($tour['nom'])): ?>
                    <h3>
                        <?= htmlspecialchars($tour['nom']) ?>
                    </h3>
                <?php endif; ?> 

                <?php if (isset($tour['degat'])): ?>
                    <p>Dégâts:
                        <?= htmlspecialchars($tour['degat']) ?>
                    </p>
                <?php endif; ?>

            </div>
            <?php
        } else {
            echo "<p>Informations sur la tour non disponibles.</p>";
        }
    }

    public function afficherPopupTour($tour)
{
    // Vérifier si les informations de la tour sont disponibles
    if (isset($tour['id_tour'])):
?>
<div class="modal" tabindex="-1" role="dialog" style="display: block; position: fixed; top: 55%; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de la tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Nom de la tour: <?= htmlspecialchars($tour['nom']) ?></p>
                <p>Prix: <?= htmlspecialchars($tour['prix']) ?></p>
                <p>Description: <?= htmlspecialchars($tour['description']) ?></p>
                <p>Dégât: <?= htmlspecialchars($tour['degat']) ?></p>
                <?php if (isset($tour['image']) && file_exists($tour['image'])): ?>
                    <img src="<?= htmlspecialchars($tour['image']) ?>" class="img-fluid" alt="Image de la tour <?= htmlspecialchars($tour['nom']) ?>"><br>
                <?php else: ?>
                    <p>Image non disponible.</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?module=tours'">Retour à la liste des tours</button>
            </div>
        </div>
    </div>
</div>
<?php
    endif;
}



    public function afficherPopupErreur($message)
    {
        echo '<div class="popup">' . $message . '</div>';
    }

}
?>