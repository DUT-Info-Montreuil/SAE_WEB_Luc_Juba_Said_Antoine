<?php
    require_once "vue_generique.php";
   

class VueSucces extends vueGenerique{
    public function __construct(){
        parent::__construct();
    }
    

    public function affiche_la_page_succes_vue($tableau) {

        $realisations = $this->verif_le_succes($tableau);
        

        
        $accomplies = array_sum(array_column($realisations, 'accompli'));
        $total = count($realisations);
        $pourcentageAccompli = $total > 0 ? ($accomplies / $total * 100) : 0;
        unset($realisation);
        ?>
        <div class="container-fluid mt-4">
            <h2 class="text-center">Vos succès</h2>
            <div class="progress mb-3">
                <div class="progress-bar" style="width:<?php echo $pourcentageAccompli; ?>%"><?php echo round($pourcentageAccompli); ?>%</div>
            </div>
            <div class="row">
                <?php foreach ($realisations as $index => $realisation): ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3 custom-col">
                        <div class="card h-100 custom-card">
                            <div class="card-body">
                                <h5 class="card-title text-truncate" title="<?php echo htmlspecialchars($realisation['titre']); ?>">
                                    <?php echo htmlspecialchars($realisation['titre']); ?>
                                </h5>
                                <p class="card-text">Statut : <?php echo isset($tableau[$index]) && $tableau[$index] ? 'accompli' : 'inachevé'; ?></p>
                            </div>
                            <div class="card-footer">
                                <img src="modules/mod_succes/images/<?php echo isset($tableau[$index]) && $tableau[$index] ? $realisation['image_unlocked'] : $realisation['image_locked']; ?>" 
                                     alt="Succès" 
                                     class="img-fluid custom-img">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
    
    public function verif_le_succes($tableau_verif_succes){

        $realisations = [
            ['titre' => 'Vingt Ennemis Tués Dans 5 Vagues', 'accompli' => false, 'image_locked' => 'cadenas.png', 'image_unlocked' => 'vingtennemistue.png'],
            ['titre' => 'Obtient 1000 Points En Une Partie', 'accompli' => true, 'image_locked' => 'cadenas.png', 'image_unlocked' => 'piece1000.png'],
            ['titre' => 'Cinquante Ennemis Abattus Sans Dégâts', 'accompli' => false, 'image_locked' => 'cadenas.png', 'image_unlocked' => 'cinquatennemistuesansdegat.png'],
            ['titre' => 'Gangé avec Quatre tours Sans Dégâts', 'accompli' => false, 'image_locked' => 'cadenas.png', 'image_unlocked' => 'gagneravec4tours.png'],
            ['titre' => 'Survivre Cinq Vague Sans Dégâts', 'accompli' => true, 'image_locked' => 'cadenas.png', 'image_unlocked' => 'survivre_cinque_vague.png'],
            ['titre' => 'Battre un nombre de vague avec motié moins de tours', 'accompli' => false, 'image_locked' => 'cadenas.png', 'image_unlocked' => 'doubleVague_tours.png'],
            
        ];
        foreach ($realisations as $index => &$realisation) {
            if (isset($tableau_verif_succes[$index])) {
                $realisation['accompli'] = $tableau_verif_succes[$index];
            } else {
                $realisation['accompli'] = false;
            }
        }
        
        return  $realisations;
    }

    

}