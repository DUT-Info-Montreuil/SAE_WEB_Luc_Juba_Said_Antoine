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
        $token = CSRFToken::genererToken();
        ?>
        <div class="search-bar">
            <form action="index.php?module=tours&action=recherche" method="post">
            <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">  <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                <input type="text" name="search" placeholder="Rechercher un tour par nom...">
                <button type="submit"  class="btn btn-primary">Rechercher</button>
            </form>
        </div>
        <?php
    }

    
    public function afficherPopupTour($tour){
        ?>
        <div class="container mt-5">
            <div class="card mx-auto" style="max-width: 1000px;"> 
                <div class="row g-0">
                    <div class="col-lg-5 d-flex align-items-center justify-content-center"> 
                        <img src="<?php echo htmlspecialchars($tour['image']); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($tour['nom']); ?>" style="max-height: 400px;"> 
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body text-center"> 
                            <h5 class="card-title">Détails de <?php echo htmlspecialchars($tour['nom']); ?></h5>
                            <p class="card-text"><strong>Nom:</strong> <?php echo htmlspecialchars($tour['nom']); ?></p>
                            <p class="card-text"><strong>Prix:</strong> <?php echo htmlspecialchars($tour['prix']); ?></p>
                            <p class="card-text"><strong>Attaque:</strong> <?php echo htmlspecialchars($tour['degat']); ?></p>
                            <p class="card-text"><strong>Descriptif:</strong> <?php echo htmlspecialchars($tour['description']); ?></p>
                            <a href="index.php?module=tours&action=Test" class="btn btn-primary">Retour à la liste des tour</a>
                            <?php 
                                if(isset($_SESSION['login']) && $_SESSION['login']['id_r']==2) {
                                    $this->modalEdition($tour);
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
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

    public function afficherPopupErreur($message)
    {
        echo '<div class="popup">' . $message . '</div>';
    }

    public function modalEdition($tour) {
        $token = CSRFToken::genererToken();
        ?>
              
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Modifier
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier : <?php echo $tour['nom']; ?> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?module=tours&action=update"method="post">
                <input type="hidden" name="id" value="<?php echo $tour['id_tour']; ?>">
                <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" id="exampleInput"  name="nom" placeholder="nom" value="<?php echo $tour['nom']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix</label>
                        <input type="number" class="form-control" id="exampleInput"  name="prix" value="<?php echo $tour['prix']; ?>" placeholder="prix" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dégat</label>
                        <input type="number" class="form-control" id="exampleInput"  name="degat" value="<?php echo $tour['degat']; ?>" placeholder="dégat" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required value="<?php echo $tour['description'];?>"><?php echo $tour['description'];?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
        </div>

        <?php
    }

    public function valide() {
        ?>
        <div class="alert alert-success mt-5 mx-auto" role="alert">
            Changement effectuer avec succès.
        </div>
        <?php
    }

    public function invalide() {
        ?>
        <div class="alert alert-danger mt-5 mx-auto" role="alert">
            Une erreur inattendu est survenu !
        </div>
        <?php 
    }

}
?>