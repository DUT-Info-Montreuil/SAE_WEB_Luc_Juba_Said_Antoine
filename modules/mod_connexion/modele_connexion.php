<?php

require_once('connexion.php');

class ModeleConnexion extends Connexion {

    public function __construct(){}

    public function inscrire() {
        if(isset($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && !empty($_POST['login'])) {
            $query = self::$bdd->prepare("INSERT INTO Utilisateur(pseudo,mot_de_passe) VALUES(?,?)");
            $query->execute(array(
                htmlspecialchars($_POST['login']),
                htmlspecialchars(password_hash($_POST['mdp'],PASSWORD_DEFAULT))
                )
            );

            if($query->rowCount()==0) {
                return false;
            }else {
                return true;
            }
        }
        return false;
    }

    public function verifUtilisateurs() {
        if(isset($_POST['login'])) {
            $query = self::$bdd->prepare("SELECT * FROM Utilisateur WHERE pseudo = ?");
            $query->execute(array(htmlspecialchars($_POST['login'])));

            if($query->rowCount()==0) {
                return true;
            }else {
                return false;
            }
        }
        return false;
    }

    public function connexion() {
        if(isset($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && !empty($_POST['login'])) {
            $query = self::$bdd->prepare("SELECT * FROM Utilisateur WHERE pseudo = ?");
            $query->execute(array(htmlspecialchars($_POST['login'])));
            $res = $query->fetch();

            if(!empty($res)) {
                if(password_verify(htmlspecialchars($_POST['mdp']),$res['mot_de_passe'])) {
                    return $res['id_utilisateur'];
                }
            }else {
                return false;
            }
        }
        return false;
    }
}

?>