<?php
require "modele_tours.php";
require "vue_tours.php";

class ContTours {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleTours();
        $this->vue = new VueTours();
    }

    public function afficheTours() {
        $this->vue->afficherBarre();
        $tours = $this->modele->getTours();
        $this->vue->afficherTours($tours);
    }

    public function rechercheTours() {
        echo "affiche tour";
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $nomTour = $_POST['search'];
            $resultatRecherche = $this->modele->rechercheTours($nomTour);
            //var_dump($resultatRecherche);

            if ($resultatRecherche) {
                $this->vue->afficherPopupTour($resultatRecherche);
            } else {
                $this->vue->afficherPopupErreur("Tour non trouvée.");
            }
        
    }
    
    
    
}
}
?>
