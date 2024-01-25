<?php

require_once('connexion.php');

class ModeleAdmin extends Connexion {

    public function __construct(){}

    public function countUser() {
        $query = self::$bdd->prepare("SELECT count(*) FROM Utilisateur");
        $res = $query->execute();
        return $res;
    }

    public function getUtilisateurs() {
        $query = self::$bdd->prepare("SELECT id_utilisateur,pseudo FROM Utilisateur WHERE id_role = 1");
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function deleteUtilisateur($id) {
        $query = self::$bdd->prepare("DELETE FROM Utilisateur WHERE id_utilisateur = ?");
        $query->execute(array($id));
        $rowCount = $query->rowCount();
        return $rowCount; 
    }

    public function getNombreCompte() {
        $query = self::$bdd->prepare("SELECT COUNT(*) FROM Utilisateur");
        $query->execute();
        $res = $query->fetch();
        return $res[0]; 
    }

    public function getMeilleurJoueur() {
        $query = self::$bdd->prepare("SELECT Utilisateur.pseudo, MAX(Partie.score) as max_score FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur GROUP BY Utilisateur.id_utilisateur ORDER BY max_score DESC LIMIT 1");
        $query->execute();
        $res = $query->fetch();
        return $res[0];
    }

    public function getNombrePartie() {
        $query = self::$bdd->prepare("SELECT COUNT(*) FROM Partie");
        $query->execute();
        $res = $query->fetch();
        return $res[0]; 
    }

    public function getNombreFeedback() {
        $query = self::$bdd->prepare("SELECT COUNT(*) FROM Feedback");
        $query->execute();
        $res = $query->fetch();
        return $res[0]; 
    }
    
    public function rechercherUtilisateur() {
        $query = self::$bdd->prepare("SELECT id_utilisateur,pseudo FROM Utilisateur WHERE pseudo LIKE CONCAT('%', ?, '%') AND id_role = 1");
        $query->execute(array(htmlentities($_GET['recherche'])));
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function recupererFeedback_modele() {
        $query = self::$bdd->prepare("SELECT nom_utilisateur,email,commentaire FROM Feedback");
        $query->execute();
        $res = $query->fetchAll(); // Utiliser fetchAll() pour obtenir tous les résultats
        // var_dump($res); // Pour déboguer et voir le contenu de $res
        return $res; 
    }
}

?>