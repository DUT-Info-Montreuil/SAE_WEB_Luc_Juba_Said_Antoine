<?php
    require_once "connexion.php";


class ModeleSucces extends Connexion{
    private $resultats = [];
    public function __construct() {
        $this-> cinquant_ennemis_tue_sans_degat();
        $this->gagner_avec_qautre_tours();
    }

    public function obtenirStatsUtilisateur() {
        try {
            $stmt = self::$bdd->prepare('SELECT ennemis_tuer,score FROM Partie WHERE id_utilisateur = 4');
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultat) {
                
                $this->resultats[0] = $resultat['ennemis_tuer'] >= 20;
                $this->resultats[1] = $resultat['score'] >= 1000;
            } else {
                $this->resultats[0] = false;
                $this->resultats[1] = false;
            }
        } catch (PDOException $e) {
            $this->resultats[0] = false;
            $this->resultats[1] = false;
        }
    }
    public function cinquant_ennemis_tue_sans_degat(){

        try {
            $stmt = self::$bdd->prepare('SELECT ennemis_tuer FROM Partie WHERE id_utilisateur = 4 and degat = 0');
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultat) {
                $this->resultats[2] = $resultat['ennemis_tuer'] >= 50;
              
            } else {
                $this->resultats[2] = false;
              
            }
        } catch (PDOException $e) {
            $this->resultats[2] = false;
            
        }
    }

    public function gagner_avec_qautre_tours(){
        try {
            $stmt = self::$bdd->prepare('SELECT nombre_tours FROM Partie WHERE id_utilisateur = 4 and degat = 0');
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultat) {
                $this->resultats[3] = $resultat['nombre_tours'] <= 4;
              
            } else {
                $this->resultats[3] = false;
              
            }
        } catch (PDOException $e) {
            $this->resultats[3] = false;
            
        }
    }

    
    

    public function obtenirResultats_tableau() {
        return $this->resultats;
    }


    

}