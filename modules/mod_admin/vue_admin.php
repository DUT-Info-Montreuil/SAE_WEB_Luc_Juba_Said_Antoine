<?php

include_once("vue_generique.php");

class VueAdmin extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function affiche_Tableau_de_Bord($tab,$data){
        ?>
        <div class="container text-center mt-5">
            <h1> Tableau de bord : </h1>
            <div class="bloc-dashboard mt-5 mb-5 mx-auto text-white fw-bold">
                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 text-center d-flex justify-content-center">
                    <div class="col">
                        <p>Compte inscrit en tout</p>
                        <div class="cercle">
                            <p  class="text-black"> <?php echo $data['nbrInscrit']; ?> </p>
                        </div>
                    </div>
                    <div class="col">
                        <p>Meilleur joueur global</p>
                        <div class="cercle">
                            <p class="text-black"> <?php echo $data['meilleurJoueur']; ?> </p>
                        </div>
                    </div>
                    <div class="col">
                        <p>Nombre de partie</p>
                        <div class="cercle">
                            <p  class="text-black"> <?php echo $data['nbrPartie']; ?> </p>
                        </div>
                    </div>
                    <div class="col">
                        <p>Total des feedback</p>
                        <div class="cercle">
                            <p  class="text-black"> <?php echo $data['nbrFeedback']; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $this->recherche(); ?>
            <div id="tableUtilisateurs">
                <?php echo $this->affiche_utilisateur($tab); ?>
            </div>
        </div>
        <?php
    }
    

    public function affiche_utilisateur($tab){
    ?>
        <div class="container">
            <div class="table-responsive" style="width: 60%; height: 300px; overflow-y: auto; margin: 0 auto;">
                <table class="table table-dark table-hover table-sm mx-auto">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Id</th>
                            <th scope="col" class="text-center">Nom</th>
                            <th scope="col" class="text-center">Suppression</th>
                        </tr>
                    </thead>
                    <?php foreach ($tab as $value) { ?>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center"><?php echo $value['id_utilisateur']; ?></th>
                                <td class="text-center"><?php echo $value['pseudo']; ?></td>
                                <td class="text-center"><?php $this->modal_supprimer($value['id_utilisateur']); ?></td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    <?php
    }

    public function modal_supprimer($userId) {
        $modalId = "staticBackdrop-" . $userId;
        $deleteId = "delete-" . $userId;
        ?>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>">
                Supprimer
            </button>
            <div class="modal fade" id="<?php echo $modalId; ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="<?php echo $modalId; ?>Label">Suppression de joueur</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                <h4> Êtes-vous sûr de supprimer le compte de cet utilisateur ? </h4>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" data-user-id="<?php echo $userId; ?>" id="<?php echo $deleteId; ?>">Valider</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    public function recherche() {
        ?>
            <div class="container mb-5">
                <div class="d-flex justify-content-center">
                    <input class="form-control me-2" id="searchInput" type="search" placeholder="Rechercher utilisateur" aria-label="Search" style="width: 320px;">
                </div>
            </div>
        <?php
    }   
    
    public function afficherFeedbacks($feedbacks){
        ?>
        <div id="liste_feedbacks" class="container mt-3">
        <?php if (empty($feedbacks)): ?>
            <div class="alert alert-warning" role="alert">
                Aucun feedback pour le moment.
            </div>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($feedbacks as $feedback): ?>
                    <?php if (isset($feedback['commentaire'])): ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Nom Utilisateur : <?= htmlspecialchars($feedback['nom_utilisateur']) ?></h5>
                                <small class="text-muted"><?= htmlspecialchars($feedback['email']) ?></small>
                            </div>
                            <p class="mb-1"> Commentaire : <?= htmlspecialchars($feedback['commentaire']) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
        <?php
    }
    
    
    

}



?>