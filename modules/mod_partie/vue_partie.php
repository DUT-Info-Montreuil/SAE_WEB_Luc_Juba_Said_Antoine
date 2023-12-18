<?php

include_once("vue_generique.php");

class VuePartie extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }

    public function affiche_partie($tab) {
        ?> 
        <div class="d-flex flex-column align-items-center">
        <h1 class="text-center"> Historique des parties : </h1>
        <?php echo $this->filtre(); ?>
            <?php 
            foreach($tab as $values) { 
                ?>
                <div class="list-group">
                    <a href="index.php?module=partie&action=details&id=<?php echo $values['id_partie'];?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Partie du : </h5>
                        <small class="text-body-secondary"> <?php echo $values['date']; ?> </small>
                        </div>
                        <p class="mb-1"> Cliquez pour voir le détail de la partie.</p>
                    </a>
                    </div>
                <?php
            } 
            ?>
    </div>
    <?php
    }

    public function affiche_details($partieCourrante,$acteursApparu,$toursPoser) {
        ?>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="card mb-3" style="width: 32rem;">
                <div class="card-header">
                    <h5 class="card-title">Partie du : <?php echo $partieCourrante['date']; ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"> Nombre de vague : <?php echo $partieCourrante['nombre_vague']; ?></p>
                    <p class="card-text"> Ennemis tué : <?php echo $partieCourrante['ennemis_tuer']; ?></p>
                    <p class="card-text"> Nombre tours : <?php echo $partieCourrante['nombre_tours']; ?></p>
                    <p class="card-text"> Score : <?php echo $partieCourrante['score']; ?></p>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Acteurs apparu :
                            </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <?php
                                        if(!empty($acteursApparu)) {
                                            foreach ($acteursApparu as $value) {
                                                ?> 
                                                    <strong> <?php echo $value['nom']; ?> </strong> 
                                                    <br>
                                                <?php
                                            }
                                        }else {
                                            ?> 
                                            <div class="alert alert-info" role="alert">
                                                <strong> Aucun acteurs n'est apparu durant votre partie. </strong> 
                                            </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Tours posé :
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <?php
                                        if(!empty($toursPoser)) {
                                            foreach ($toursPoser as $value) {
                                                ?> 
                                                    <strong> <?php echo $value['nom']; ?> </strong> 
                                                    <br>
                                                <?php
                                            }
                                        }else{
                                            ?> 
                                            <div class="alert alert-info" role="alert">
                                                <strong> Aucune tourelle n'a été poser durant votre partie. </strong> 
                                            </div>
                                                
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function filtre() {
        ?>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Filtre partie
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?module=partie&action=listeJournalier">Journalier</a></li>
                <li><a class="dropdown-item" href="index.php?module=partie&action=listeHebdo">Hebdomadaire</a></li>
                <li><a class="dropdown-item" href="index.php?module=partie&action=listeMensuelle">Mensuelle</a></li>
            </ul>
        </div>
        <?php
    }

    public function aucune_partie() {
        ?>
        <p> Aucune partie n'a été jouer. </p>
        <?php
    }
}

?>