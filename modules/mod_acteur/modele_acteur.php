<?php
    require_once "connexion.php";

class ModeleActeur extends Connexion{
    public  function __construct() {

    }
    public function getListe($pageActuelle, $acteursParPage) {
        $offset = ($pageActuelle - 1) * $acteursParPage;
        $stmt = self::$bdd->prepare('SELECT * FROM Acteurs LIMIT :limit OFFSET :offset');

        // Bind les valeurs avec les paramètres
        $stmt->bindValue(':limit', $acteursParPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getNombreTotalActeurs() {
        $stmt = self::$bdd->prepare('SELECT COUNT(*) FROM Acteurs');
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_NUM);
        return $resultat[0]; // Retourne le nombre total d'acteurs
    }
    

    public function detail($id){
        $stmt = self::$bdd->prepare('SELECT * FROM Acteurs WHERE id_acteurs = :id');
        $stmt->execute(array('id' => $id));
        $tableresultat=$stmt->fetch();
        return $tableresultat;

    }

    public function rechercheActeur($nom) {
        $sql = "SELECT * FROM Acteurs WHERE nom = :nom";
        $stmt = self::$bdd->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function rechercheActeurParNom($searchTerm) {
        $sql = self::$bdd->prepare("SELECT * FROM Acteurs WHERE nom LIKE ?");
        $sql->execute(array('%' . $searchTerm . '%'));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateActeur() {
        if(isset($_POST['nom']) && isset($_POST['pv']) && isset($_POST['attaque']) && isset($_POST['descriptif']) && isset($_POST['id'])) {
            
            $nom = $_POST['nom'];
            $pv = $_POST['pv'];
            $attaque = $_POST['attaque'];
            $descriptif = $_POST['descriptif'];
            $id = $_POST['id'];
    
            $query = self::$bdd->prepare("UPDATE Acteurs SET nom = ?, pv = ?, attaque = ?, descriptif = ? WHERE id_acteurs = ?");
            $res = $query->execute(array(
                htmlentities($nom), 
                htmlentities($pv), 
                htmlentities($attaque),
                htmlentities($descriptif), 
                htmlentities($id)
            ));
    
            return $res; 
        } else {
            return false;
        }
    }
    
    
}