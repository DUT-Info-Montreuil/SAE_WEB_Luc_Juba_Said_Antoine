<?php

require_once('connexion.php');

class ModeleJoueur extends Connexion {

    public function __construct(){}

    public function getStatJoueur($typeStat) {
        if (isset($_SESSION['login'])) {
            switch ($typeStat) {
                case 'avg':
                    $sql = "SELECT ROUND(AVG(nombre_vague),2) AS moyenne_vague,
                                     ROUND(AVG(ennemis_tuer),2) AS moyenne_tuer,
                                     ROUND(AVG(nombre_ennemis),2) AS moyenne_ennemis,
                                     ROUND(AVG(nombre_tours),2) AS moyenne_tours 
                             FROM Partie  
                             WHERE id_utilisateur = ?";
                    break;
                case 'max':
                    $sql = "SELECT MAX(nombre_vague) AS max_vague,
                                   MAX(ennemis_tuer) AS max_tuer,
                                   MAX(nombre_ennemis) AS max_ennemis,
                                   MAX(nombre_tours) AS max_tours 
                             FROM Partie 
                             WHERE id_utilisateur = ?";
                    break;
                case 'min':
                    $sql = "SELECT MIN(nombre_vague) AS min_vague,
                                   MIN(ennemis_tuer) AS min_tuer,
                                   MIN(nombre_ennemis) AS min_ennemis,
                                   MIN(nombre_tours) AS min_tours 
                             FROM Partie 
                             WHERE id_utilisateur = ?";
                    break;
                default:
                    return null;
            }
    
            $query = self::$bdd->prepare($sql);
            $query->execute(array(htmlentities($_SESSION["login"]['id_u'])));
            return $query->fetch();
        }
    
        return null;
    }
    
    public function getStatMoyenneGlobale() {
        $query = self::$bdd->prepare(
            "SELECT ROUND(AVG(ennemis_tuer), 0) AS Moyenne_tuer,
                    ROUND(AVG(nombre_vague), 0) AS Moyenne_vague,
                    ROUND(AVG(nombre_tours), 0) AS Moyenne_tours,
                    ROUND(AVG(score), 0) AS Moyenne_score,
                    MONTH(date) AS mois_num,
                    MONTHNAME(date) AS mois 
            FROM Partie GROUP BY mois_num, mois  ORDER BY mois_num");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatMoyenneJoueur() {
        if(isset($_SESSION["login"])) {
            $query = self::$bdd->prepare(
            "SELECT 
                ROUND(AVG(ennemis_tuer), 0) AS Moyenne_tuer_joueur,
                ROUND(AVG(nombre_vague),0) as Moyenne_vague_joueur,
                ROUND(AVG(nombre_tours), 0) AS Moyenne_tours_joueur,
                ROUND(AVG(score), 0) AS Moyenne_score_joueur,
                MONTH(date) AS mois_num,MONTHNAME(date) AS mois 
            FROM Partie
            WHERE id_utilisateur = ? GROUP BY mois_num, mois ORDER BY `mois_num`");
            $query->execute(array(htmlentities($_SESSION["login"]['id_u'])));
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

    public function getDesClassementJoueur($classementType) {

        $orderBy = ($classementType === 'score') ? 'score' : 'nombre_vague';
    
        $query = self::$bdd->prepare("SELECT Utilisateur.pseudo, MAX(Partie.$orderBy) AS max_value
        FROM Partie 
        INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur 
        GROUP BY Utilisateur.pseudo 
        ORDER BY max_value DESC");
    
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getInfoProfil(){
        $id_utilisateur = $_SESSION['login']['id_u'];
        $query = self::$bdd->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = ?");
        $query->execute(array(htmlentities($id_utilisateur)));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modificationJoueur(){
        if (isset($_POST['exampleInputPassword']) && isset($_POST['exampleInputPassword1']) && isset($_SESSION['login']['id_u']))
                $hashedNewPassword = password_hash($_POST['exampleInputPassword1'], PASSWORD_DEFAULT);
                $query = self:: $bdd->prepare("UPDATE Utilisateur SET ? = ? WHERE id_utilisateur = ?");
                $query->execute(array(htmlspecialchars($hashedNewPassword)));
    }
}

?>