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

    public function getPartie($id) {
        $query = self::$bdd->prepare("SELECT * FROM Partie INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur WHERE pseudo = ? AND id_partie = ?");
        $query->execute(array(htmlentities($_SESSION['login']),htmlentities($id)));
        $res = $query->fetch();
        return $res;
    }

}

?>