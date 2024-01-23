<?php

require_once('connexion.php');

class ModeleAdmin extends Connexion {

    public function __construct(){}

    public function countUser() {
        $query = self::$bdd->prepare("SELECT count(*) FROM Utilisateur");
        $res = $query->execute();
        return $res;
    }

    public function getAllUser() {
        $query = self::$bdd->prepare("SELECT id_utilisateur,pseudo FROM Utilisateur WHERE id_role = 1");
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function getPseudo($id) {
        $query = self::$bdd->prepare("SELECT pseudo FROM Utilisateur where id_utilisateur = ?");
        $query->execute(array($id));
        $res = $query->fetch();
        return $res;
    }
}

?>