<?php

require_once('connexion.php');

class ModeleTopic extends Connexion {

    public function __construct(){}

    public function insertTopic() {
        if(isset($_POST['question']) && isset($_POST['descriptif'])) {
            $query = self::$bdd->prepare("INSERT INTO Topic(question,intituler,id_utilisateur) VALUES(?,?,?)");
            $query->execute(array(htmlentities($_POST['question']),htmlentities($_POST['descriptif']),htmlentities($_SESSION['login']['id_u'])));
            return true;
        }
        return false;
    }

    public function getAllTopic() {
        $query = self::$bdd->prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS dateTopic FROM Topic INNER JOIN Utilisateur ON Topic.id_utilisateur = Utilisateur.id_utilisateur");
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function countMessageTopic($id) {
        $query = self::$bdd->prepare("SELECT COUNT(*) as nombre FROM `Message` INNER JOIN Topic ON Message.id_topic = Topic.id_topic WHERE Topic.id_topic = ?");
        $query->execute(array($id));
        $res = $query->fetch();
        return $res;
    }

    public function getTopic() {
        if(isset($_GET['id'])) {
            $query = self::$bdd->prepare("SELECT * FROM Topic INNER JOIN Utilisateur ON Topic.id_utilisateur = Utilisateur.id_utilisateur WHERE id_topic = ?");
            $query->execute(array(htmlentities($_GET['id'])));
            return $query->fetch();
        }
    }

    public function getAllMessageByTopic() {
        $query = self::$bdd->prepare("SELECT *, DATE_FORMAT(Message.date, '%d/%m/%Y') AS dateMessage, DATE_FORMAT(Message.date, '%H:%i') AS heureMessage FROM Message INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = Message.id_utilisateur WHERE id_topic = ? ORDER BY dateMessage ASC,heureMessage ASC");
        $query->execute(array(htmlentities($_GET['id'])));
        $res = $query->fetchAll();
        return $res;
    }

    public function insererCommentaire() {
        if(isset($_POST['com']) && isset($_SESSION['login'])) {
            $query = self::$bdd->prepare("INSERT INTO Message(contenu,id_topic,id_utilisateur) VALUES(?,?,?)");
            $query->execute(array(
                htmlentities($_POST['com']),
                htmlentities($_POST['id_topic']),
                htmlentities($_SESSION['login']['id_u'])
            ));
            return true;
        }
        return false;
    }

    public function deleteCommentaire($id) {
        if(isset($_SESSION['login'])) {
            $query = self::$bdd->prepare("DELETE FROM Message WHERE id_message = ?");
            $query->execute(array(htmlentities($id)));
            $rowCount = $query->rowCount();
            if($rowCount>0) {
                return true;
            }
        }
        return false;
    }

    public function updateCommentaire($id) {
        if(isset($_SESSION['login']) && isset($_POST['nouveauMessage'])) {
            $query = self::$bdd->prepare("UPDATE Message SET contenu = ? WHERE id_message = ?");
            $query->execute(array($_POST['nouveauMessage'], htmlentities($id)));
            $rowCount = $query->rowCount();
            if($rowCount > 0) {
                return true;
            }
        }
        return false;
    }
        
}

?>