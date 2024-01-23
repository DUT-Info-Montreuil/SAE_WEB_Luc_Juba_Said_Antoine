<?php
require_once "connexion.php";

class ModeleSucces extends Connexion {
    private $resultats = [];
    private $id_user;

    public function __construct() {
        $this->id_user = $_SESSION['login']['id_u'];
        $this->obtenirStatsSucces();
        $this->cinquant_ennemis_tue_sans_degat();
        $this->gagner_avec_qautre_tours();
        $this->survivre_cinq_vague_sans_degat();
        $this->battre_nombre_vague_avec_moitie_moins_tours();
        
    }

    public function obtenirStatsSucces() {
        try {
            $stmt = self::$bdd->prepare('SELECT ennemis_tuer, score FROM Partie WHERE id_utilisateur = :id_user');
            $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultat) {
                $this->resultats[0] = (int)$resultat['ennemis_tuer'] >= 20;
                $this->resultats[1] = (int)$resultat['score'] >= 1000;
            } else {
                $this->resultats[0] = false;
                $this->resultats[1] = false;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $this->resultats[0] = false;
            $this->resultats[1] = false;
        }
    }

    public function cinquant_ennemis_tue_sans_degat() {
        try {
            $stmt = self::$bdd->prepare('SELECT ennemis_tuer FROM Partie WHERE id_utilisateur = :id_user and degat = 0');
            $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultat) {
                $this->resultats[2] = (int)$resultat['ennemis_tuer'] >= 50;
            } else {
                $this->resultats[2] = false;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $this->resultats[2] = false;
        }
    }

    public function gagner_avec_qautre_tours() {
        try {
            $stmt = self::$bdd->prepare('SELECT nombre_tours FROM Partie WHERE id_utilisateur = :id_user and degat = 0');
            $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultat) {
                $this->resultats[3] = (int)$resultat['nombre_tours'] <= 4;
            } else {
                $this->resultats[3] = false;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $this->resultats[3] = false;
        }
    }
    public function survivre_cinq_vague_sans_degat(){
        try {
        $stmt = self::$bdd->prepare('SELECT nombre_vague FROM Partie WHERE id_utilisateur = :id_user and degat = 0');
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            $this->resultats[4] = (int)$resultat['nombre_vague'] >= 5;
        } else {
            $this->resultats[4] = false;
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        $this->resultats[4] = false;
    }
    }

    public function battre_nombre_vague_avec_moitie_moins_tours() {
        try {
            $stmt = self::$bdd->prepare('SELECT nombre_vague, nombre_tours FROM Partie WHERE id_utilisateur = :id_user AND degat = 0');
            $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultat && (int)$resultat['nombre_tours'] > 0) {
                $this->resultats[5] = (int)$resultat['nombre_vague'] >= ((int)$resultat['nombre_tours'] * 2);
            } else {
                $this->resultats[5] = false;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            $this->resultats[5] = false;
        }
    }
    


    public function obtenirResultats_tableau_succes() {
        return $this->resultats;
    }
}
