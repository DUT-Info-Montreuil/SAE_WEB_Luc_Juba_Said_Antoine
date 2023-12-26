<?php

require_once('connexion.php');

class ModeleJoueur extends Connexion {


    public function __construct(){}


    public function getDesClassementJoueur($classementType) {

        $orderBy = ($classementType === 'score') ? 'score' : 'nombre_vague';
    
        $query = self::$bdd->prepare("SELECT Utilisateur.pseudo, MAX(Partie.$orderBy) AS max_value
        FROM Partie 
        INNER JOIN Utilisateur ON Partie.id_utilisateur = Utilisateur.id_utilisateur 
        GROUP BY Utilisateur.pseudo 
        ORDER BY max_value DESC");
    
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getInfoProfil(){
        $pseudo = $_SESSION['login'];
        $query = self::$bdd->prepare("SELECT * FROM Utilisateur WHERE pseudo = ?");
        $query->execute(array($pseudo));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modificationJoueur(){
        if (issert($_POST['exampleInputPassword']) && issert($_POST['exampleInputPassword1']) && issert($_SESSION['login']))
                $hashedNewPassword = password_hash($_POST['exampleInputPassword1'], PASSWORD_DEFAULT);
                $query = self:: $bdd->prepare("UPDATE Utilisateur SET ? = ? WHERE pseudo = ?");
                $query->execute(array(htmlspecialchars($hashedNewPassword)));
    }

}

?>