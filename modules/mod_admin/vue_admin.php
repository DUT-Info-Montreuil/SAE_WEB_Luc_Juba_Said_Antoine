<?php

include_once("vue_generique.php");

class VueAdmin extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function affiche_Tableau_de_Bord($tab){
    ?>
        <div class="container text-center mt-5">
            <h1> Tableau de bord : </h1>
            <?php echo $this->affiche_utilisateur($tab); ?>
        </div>
    <?php
    }

    public function affiche_utilisateur($tab){
    ?>
        <div class="container">
            <table class="table table-dark table-hover table-sm mx-auto" style="width: 50%;">
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
    <?php
    }

    public function modal_supprimer($userId) {
        ?>
            <button type="button" class="btn btn-danger" id='user-id-<?php echo $userId; ?>' data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Supprimer
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Suppression de joueur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                       <h4> Êtes-vous sûr de supprimer le compte de cet l'utilisateur ? </h4>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary">Valider</button>
                </div>
                </div>
            </div>
            </div>
        <?php
    }
}

?>