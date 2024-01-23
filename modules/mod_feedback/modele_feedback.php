<?php
require_once 'Connexion.php';
require_once 'mod_feedback.php';


class ModeleFeedback extends Connexion {
    public function insererFeedback() {
    
        $requete = self::$bdd->prepare("INSERT INTO Feedback (id_utilisateur,nom_utilisateur,email,commentaire) VALUES (?,?,?,?)");
        $requete->execute(array($_SESSION['login'],$_POST['nom_utilisateur'],$_POST['email'],$_POST['commentaire']));
    }
}

?>
