<?php
require_once 'Connexion.php';
require_once 'mod_feedback.php';


class ModeleFeedback extends Connexion {
    public function insererFeedback() {
        /*
        try {
          
            $requete = self::$bdd->prepare("INSERT INTO Feedback (id_utilisateur, nom_utilisateur, email, commentaire) VALUES (?, ?, ?, ?)");
            return $requete->execute(array(htmlentities($_SESSION['login']),htmlentities($_POST('nom_utilisateur')),htmlentities($_POST('email')),htmlentities($_POST('commentaire'))));
        } catch (Exception $e) {
            // Gestion des erreurs
            die('Erreur : ' . $e->getMessage());
        }
        */
        $requete = self::$bdd->prepare("INSERT INTO Feedback (id_utilisateur,nom_utilisateur,email,commentaire) VALUES (?,?,?,?)");
        $requete->execute(array($_SESSION['login'],$_POST['nom_utilisateur'],$_POST['email'],$_POST['commentaire']));
    }
}

?>
