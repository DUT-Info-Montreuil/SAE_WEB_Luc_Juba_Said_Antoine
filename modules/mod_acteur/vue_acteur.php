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



   
    public function affiche_details_acteur($acteur){
    ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 1000px;"> 
            <div class="row g-0">
                <div class="col-lg-5 d-flex align-items-center justify-content-center"> 
                    <img src="<?php echo htmlspecialchars($acteur['image']); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($acteur['nom']); ?>" style="max-height: 400px;"> 
                </div>
                <div class="col-lg-7">
                    <div class="card-body text-center"> 
                        <h5 class="card-title">Détails de <?php echo htmlspecialchars($acteur['nom']); ?></h5>
                        <p class="card-text"><strong>Id:</strong> <?php echo htmlspecialchars($acteur['id_acteurs']); ?></p>
                        <p class="card-text"><strong>Nom:</strong> <?php echo htmlspecialchars($acteur['nom']); ?></p>
                        <p class="card-text"><strong>PV:</strong> <?php echo htmlspecialchars($acteur['pv']); ?></p>
                        <p class="card-text"><strong>Attaque:</strong> <?php echo htmlspecialchars($acteur['attaque']); ?></p>
                        <p class="card-text"><strong>Descriptif:</strong> <?php echo htmlspecialchars($acteur['descriptif']); ?></p>
                        <a href="index.php?module=mod_acteur&action=liste" class="btn btn-primary">Retour à la liste des acteurs</a>
                        <?php
                            if(isset($_SESSION['login']) && $_SESSION['login']['id_r'] == 2) {
                                $this->modalEdition($acteur);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

    



public function affichage_searche_bar() {
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <form action="index.php?module=mod_acteur&action=recherche" method="post" class="d-flex justify-content-center">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un acteur par nom...">
                    <button type="submit" class="btn btn-success">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
    <?php
}


    




public function affichage_les_pages_suivant($nombreTotalDePages) {
    $pageActuelle = $this->pageActuelle;
    $pagePrecedente = max(1, $pageActuelle - 1);
    $pageSuivante = min($nombreTotalDePages, $pageActuelle + 1);
    ?>
    <nav aria-label="Page navigation example" style="display: flex; justify-content: center;">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="index.php?module=mod_acteur&action=liste&page=<?php echo $pagePrecedente; ?>">Précédent</a>
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





public function afficherPopupActeur($acteur)
{
    $this->affiche_details_acteur($acteur);
}
    public function afficherPopupErreur($message)
    {
        echo '<div class="popup">' . $message . '</div>';
    }

    public function modalEdition($acteur) {
        $token = CSRFToken::genererToken();
        ?>
              
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Modifier
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier : <?php echo $acteur['nom']; ?> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?module=mod_acteur&action=update"method="post">
                <input type="hidden" name="id" value="<?php echo $acteur['id_acteurs']; ?>">
                <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" id="exampleInput"  name="nom" placeholder="nom" value="<?php echo $acteur['nom']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PV</label>
                        <input type="number" class="form-control" id="exampleInput"  name="pv" value="<?php echo $acteur['pv']; ?>" placeholder="attaque" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Attaque</label>
                        <input type="number" class="form-control" id="exampleInput"  name="attaque" value="<?php echo $acteur['attaque']; ?>" placeholder="attaque" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descriptif" required value="<?php echo $acteur['descriptif'];?>"><?php echo $acteur['descriptif'];?></textarea>
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




    