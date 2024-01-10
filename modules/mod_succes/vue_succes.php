<?php

class VueSucces{
    public function __construct(){
        
    }
    

    public function affiche_la_page_succes() {
        $realisations = [
            ['titre' => 'Premier Ennemi', 'accompli' => true],
            ['titre' => 'Dix Ennemis', 'accompli' => true],
            ['titre' => 'Vingt Ennemis', 'accompli' => false],
        ];
        
        ?>
        <div class="container mt-4">
            <h2 class="text-center">Vos succès</h2>
            <div class="progress mb-3">
                <div class="progress-bar" style="width:10%">10%</div> <!-- Mettez à jour le pourcentage en fonction des réalisations de l'utilisateur -->
            </div>
            <div class="row">
                <?php foreach ($realisations as $realisation): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($realisation['titre']); ?></h5>
                                <p class="card-text">Condition pour le succès</p>
                                <p class="card-text">Status : <?php echo $realisation['accompli'] ? 'accompli' : 'inachevé'; ?></p>
                            </div>
                            <?php if (!$realisation['accompli']): ?>
                                <div class="card-footer">
                                    <img src="chemin_vers_image_cadenas.png" alt="Cadenas" class="img-fluid">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
                </ul>
            </nav>
        </div>
        <?php
    }
    
    

}