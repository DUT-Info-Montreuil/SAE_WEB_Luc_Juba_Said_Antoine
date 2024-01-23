<?php
require_once 'Connexion.php';
require_once 'mod_feedback.php';


class ModeleFeedback extends Connexion {
    public function insererFeedback() {
        if(isset($_SESSION['login']) && isset($_POST['email']) && $_POST['commentaire']) {
            $requete = self::$bdd->prepare("INSERT INTO Feedback (id_utilisateur,nom_utilisateur,email,commentaire) VALUES (?,?,?,?)");
            $requete->execute(array(
                htmlentities($_SESSION['login']['id_u']),
                $this->getPseudo()['pseudo'],
                htmlentities($_POST['email']),
                htmlentities($_POST['commentaire']))
            );
            return true;
        }
        return false;
    }

    public function getPseudo() {
        if(isset($_SESSION['login'])) {
            $requete = self::$bdd->prepare("SELECT pseudo FROM Utilisateur WHERE id_utilisateur = ?"); 
            $requete->execute(array($_SESSION['login']['id_u']));
            return $requete->fetch();
        }
        return null;
    }
}

?>
