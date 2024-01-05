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

    public function modificationMotDePasse() {
        if (isset($_POST['exampleInputPassword']) && isset($_POST['exampleInputPassword1']) && isset($_SESSION['login'])) {

            $query = self::$bdd->prepare("SELECT mot_de_passe FROM Utilisateur WHERE pseudo = ?");
            $query->execute(array($_SESSION['login']));
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $currentPassword = $result['mot_de_passe'];
    
                if (password_verify($_POST['exampleInputPassword'], $currentPassword)) {

                    $newPassword = $_POST['exampleInputPassword1'];

                        if (!empty($newPassword)){
                            if (!password_verify($newPassword, $currentPassword)) {

                                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                                $updateQuery = self::$bdd->prepare("UPDATE Utilisateur SET mot_de_passe = ? WHERE pseudo = ?");
                                $updateQuery->execute(array(htmlspecialchars($hashedNewPassword), $_SESSION['login']));
                                echo "Le mot de passe a été mis à jour avec succès.";                                
                            } else {
                                echo "Le nouveau mot de passe ne peut pas être identique à l'ancien.";
                            }
                        } else {
                            echo "Le nouveau mot de passe ne peut pas être vide.";
                        }
                    } else {
                        echo "Le mot de passe actuel est incorrect.";
                    }
                } else {
                    echo "Utilisateur non trouvé.";  
                }
            } else {
                echo "Tous les champs requis ne sont pas fournis."; 
        }
    }


    public function modificationDuProfile(){
        if (isset($_POST['modifierMot_De_Passe'])){
            modificationMotDePasse();
        }
    }

}

?>