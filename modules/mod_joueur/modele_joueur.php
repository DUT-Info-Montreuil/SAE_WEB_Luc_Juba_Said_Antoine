<?php
require_once('connexion.php');

class ModeleJoueur extends Connexion {

    public function __construct(){}

    public function getStatJoueur($typeStat) {
        if (isset($_SESSION['login'])) {
            switch ($typeStat) {
                case 'avg':
                    $sql = "SELECT ROUND(AVG(nombre_vague),2) AS moyenne_vague,
                                     ROUND(AVG(ennemis_tuer),2) AS moyenne_tuer,
                                     ROUND(AVG(nombre_ennemis),2) AS moyenne_ennemis,
                                     ROUND(AVG(nombre_tours),2) AS moyenne_tours 
                             FROM Partie  
                             WHERE id_utilisateur = ?";
                    break;
                case 'max':
                    $sql = "SELECT MAX(nombre_vague) AS max_vague,
                                   MAX(ennemis_tuer) AS max_tuer,
                                   MAX(nombre_ennemis) AS max_ennemis,
                                   MAX(nombre_tours) AS max_tours 
                             FROM Partie 
                             WHERE id_utilisateur = ?";
                    break;
                case 'min':
                    $sql = "SELECT MIN(nombre_vague) AS min_vague,
                                   MIN(ennemis_tuer) AS min_tuer,
                                   MIN(nombre_ennemis) AS min_ennemis,
                                   MIN(nombre_tours) AS min_tours 
                             FROM Partie 
                             WHERE id_utilisateur = ?";
                    break;
                default:
                    return null;
            }
    
            $query = self::$bdd->prepare($sql);
            $query->execute(array(htmlentities($_SESSION["login"]['id_u'])));
            return $query->fetch();
        }
    
        return null;
    }
    
    public function getStatMoyenneGlobale() {
        $query = self::$bdd->prepare(
            "SELECT ROUND(AVG(ennemis_tuer), 0) AS Moyenne_tuer,
                    ROUND(AVG(nombre_vague), 0) AS Moyenne_vague,
                    ROUND(AVG(nombre_tours), 0) AS Moyenne_tours,
                    ROUND(AVG(score), 0) AS Moyenne_score,
                    MONTH(date) AS mois_num,
                    MONTHNAME(date) AS mois 
            FROM Partie GROUP BY mois_num, mois  ORDER BY mois_num");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatMoyenneJoueur() {
        if(isset($_SESSION["login"])) {
            $query = self::$bdd->prepare(
            "SELECT 
                ROUND(AVG(ennemis_tuer), 0) AS Moyenne_tuer_joueur,
                ROUND(AVG(nombre_vague),0) as Moyenne_vague_joueur,
                ROUND(AVG(nombre_tours), 0) AS Moyenne_tours_joueur,
                ROUND(AVG(score), 0) AS Moyenne_score_joueur,
                MONTH(date) AS mois_num,MONTHNAME(date) AS mois 
            FROM Partie
            WHERE id_utilisateur = ? GROUP BY mois_num, mois ORDER BY `mois_num`");
            $query->execute(array(htmlentities($_SESSION["login"]['id_u'])));
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }

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
        $id_utilisateur = $_SESSION['login']['id_u'];
        $query = self::$bdd->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = ?");
        $query->execute(array(htmlentities($id_utilisateur)));
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
                                $updateQuery->execute(array(htmlspecialchars($hashedNewPassword),$_SESSION['login']));
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

    public function modificationPhotoDeProfil() {
        if (isset($_FILES['inputGroupFile01']['tmp_name']) && isset($_SESSION['login'])) {
    
            $targetDirectory = "modules/mod_joueur/images/"; 
            $targetFile = $targetDirectory . basename($_FILES['inputGroupFile01']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
            $check = getimagesize($_FILES['inputGroupFile01']['tmp_name']);
            if ($check !== false) {
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        echo "Désolé, seuls les fichiers JPG, JPEG et PNG sont autorisés.";
                    } else {
    
                        if (move_uploaded_file($_FILES['inputGroupFile01']['tmp_name'], $targetFile)) {
                            $updateQuery = self::$bdd->prepare("UPDATE Utilisateur SET photo_de_profile = ? WHERE id_utilisateur = ?");
                            $updateQuery->execute(array(htmlspecialchars($targetFile), $_SESSION['login']['id_u']));
                            echo "La photo de profil a été mise à jour avec succès.";
                        } else {
                            echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
                        }
                    }
                
            } else {
                echo "Le fichier n'est pas une image valide.";
            }
        } else {
            echo "Tous les champs requis ne sont pas fournis.";
        }
    }
    

    public function modificationDuProfile(){
        if (isset($_POST['modifierMot_De_Passe'])){
            $this->modificationMotDePasse();
        }else{
            $this->modificationPhotoDeProfil();
        }
    }
}

?>