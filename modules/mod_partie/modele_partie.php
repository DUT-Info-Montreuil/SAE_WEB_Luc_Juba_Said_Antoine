<?php

require_once('connexion.php');

class ModelePartie extends Connexion {

    public function __construct(){}

    public function getListePartie() {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ?");
        $query->execute(array(htmlentities($_SESSION['login'])));
        $res = $query->fetchAll();
        return $res;
    }

    public function getListePartieJournalier() {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND DATE(date) = CURDATE()");
        $query->execute(array(htmlentities($_SESSION['login'])));
        $res = $query->fetchAll();
        return $res;
    }
    
    public function getListePartieHebdomadaire() {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)");
        $query->execute(array(htmlentities($_SESSION['login'])));
        $res = $query->fetchAll();
        return $res;
    }

    public function getListePartieMensuelle() {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())");
        $pseudo = htmlentities($_SESSION['login']);
        $query->execute(array($pseudo));
        $res = $query->fetchAll();
        return $res;
    }

    public function getPartie($id) {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND id_partie = ?");
        $query->execute(array(htmlentities($_SESSION['login']),htmlentities($id)));
        $res = $query->fetch();
        return $res;
    }

}

?>