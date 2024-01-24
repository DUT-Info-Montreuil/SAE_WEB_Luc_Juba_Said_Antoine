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
}

?>