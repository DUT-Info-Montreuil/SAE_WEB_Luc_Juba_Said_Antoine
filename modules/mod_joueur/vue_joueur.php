<?php

include_once("vue_generique.php");

class VueJoueur extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }

    public function affiche_stat($moyenne,$max,$min) {
        ?>
        <div class="container text-center mt-4">
            <div class="row justify-content-center">
    
                <div class="mb-4">
                    <h1 class="text-decoration-underline">Vos statistiques</h1>
                    <img src="assets/graph-up-arrow.svg" alt="Graph" class="img-fluid">
                </div>
    
                <div class="col-md-4">
                    <div class="bg-primary text-white rounded p-3 m-1">
                        <h2> Moyenne </h2>
                        <p>Vague : <?php echo $moyenne['moyenne_vague']; ?></p>
                        <p>Ennemis : <?php echo $moyenne['moyenne_tuer']; ?></p>
                        <p>Ennemis tué : <?php echo $moyenne['moyenne_ennemis']; ?></p>
                        <p>Tourelles posé : <?php echo $moyenne['moyenne_tours']; ?></p>
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="bg-success text-white rounded p-3 m-1">
                        <h2> Maximum </h2>
                        <p>Vague : <?php echo $max['max_vague']; ?></p>
                        <p>Ennemis : <?php echo $max['max_tuer']; ?></p>
                        <p>Ennemis tué : <?php echo $max['max_ennemis']; ?></p>
                        <p>Tourelles posé : <?php echo $max['max_tours']; ?></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bg-danger text-white rounded p-3 m-1">
                        <h2> Minimum </h2>
                        <p>Vague : <?php echo $min['min_vague']; ?></p>
                        <p>Ennemis : <?php echo $min['min_tuer']; ?></p>
                        <p>Ennemis tué : <?php echo $min['min_ennemis']; ?></p>
                        <p>Tourelles posé : <?php echo $min['min_tours']; ?></p>
                    </div>
                </div>
    
            </div>
        </div>
        <?php
    }
}

?>