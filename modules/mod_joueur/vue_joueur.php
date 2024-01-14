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
        $this->affiche_graph();
    }

    public function affiche_sans_stat() {
        ?>
            <div class="text-center m-5">
                <div class="alert alert-info" role="alert">
                    Vous n'avez aucune donnée de jeu enregistrer.
                </div>
            </div>
        <?php
    }

 public function affiche_graph() {
    ?>
        <div class="text-center m-5">
            <h1>Graphique :</h1>
            <div class="dropdown m-4">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Choisir
                </button>
                <ul class="dropdown-menu ">
                    <li><button type="button" class="dropdown-item" id="ennemis-tues">Ennemis tués</button></li>
                    <li><button type="button" class="dropdown-item" id="nombre-vague">Nombre de vagues</button></li>
                    <li><button type="button" class="dropdown-item" id="nombre-tours">Nombre de tourelles posé</button></li>
                    <li><button type="button" class="dropdown-item" id="score">Score</button></li>
                </ul>
            </div>
        </div>
        <div class="container text-center mt-4" style="width: 60%;">
            <canvas id="myChart" style="height: 400px;"></canvas>
        </div>
    <?php
}

}

?>