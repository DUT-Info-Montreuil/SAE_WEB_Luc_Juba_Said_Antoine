<?php

require_once('connexion.php');

class ModelePartie extends Connexion {

    public function __construct(){}

    public function getListePartie() {
        $query = self::$bdd->prepare("SELECT * FROM Partie WHERE id_utilisateur = ? ORDER BY date DESC");
        $query->execute(array(htmlentities($_SESSION['login']['id_u'])));
        $res = $query->fetchAll();
        return $res;
    }

    public function getListePartieJournalier() {
        $query = self::$bdd->prepare("SELECT * FROM Partie WHERE id_utilisateur = ? AND DATE(date) = CURDATE() ORDER BY date DESC");
        $query->execute(array(htmlentities($_SESSION['login']['id_u'])));
        $res = $query->fetchAll();
        return $res;
    }
    
    public function getListePartieHebdomadaire() {
        $query = self::$bdd->prepare("SELECT * FROM Partie WHERE id_utilisateur = ? AND YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1) ORDER BY date DESC");
        $query->execute(array(htmlentities($_SESSION['login']['id_u'])));
        $res = $query->fetchAll();
        return $res;
    }

    public function getListePartieMensuelle() {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE()) ORDER BY date DESC");
        $pseudo = htmlentities($_SESSION['login']);
        $query->execute(array($pseudo));
        $res = $query->fetchAll();
        return $res;
    }

    public function getPartie($id) {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND Partie.id_partie = ?");
        $query->execute(array(htmlentities($_SESSION['login']),htmlentities($id)));
        $res = $query->fetch();
        return $res;
    }

    public function getActeursApparu($id) {
        $query = self::$bdd->prepare(
            "SELECT Acteurs.nom FROM Partie 
                INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur 
                INNER JOIN ActeursApparu ON ActeursApparu.id_partie = Partie.id_partie
                INNER JOIN Acteurs ON Acteurs.id_acteurs = ActeursApparu.id_acteurs
                    WHERE pseudo = ? AND Partie.id_partie = ?");
        $query->execute(array(htmlentities($_SESSION['login']),htmlentities($id)));
        $res = $query->fetchall();
        return $res;
    }

    public function getToursPoser($id) {
        $query = self::$bdd->prepare(
            "SELECT Tours.nom FROM Partie 
                INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur 
                INNER JOIN ToursPosseder ON ToursPosseder.id_partie = Partie.id_partie 
                INNER JOIN Tours ON Tours.id_tour = ToursPosseder.id_tour
                    WHERE pseudo = ? AND Partie.id_partie = ?");
        $query->execute(array(htmlentities($_SESSION['login']),htmlentities($id)));
        $res = $query->fetchall();
        return $res;
    }
}

?>