<?php
    require_once "connexion.php";

class ModeleActeur extends Connexion{
    public  function __construct() {

    }
    public  function  getListe() {

        $stmt = self::$bdd->prepare('SELECT * FROM Acteurs');
        $stmt->execute();
        $tabresault=$stmt->fetchall();
        return $tabresault;

    }
    public function detail($id){
        $stmt = self::$bdd->prepare('SELECT * FROM Acteurs WHERE id_acteurs = :id');
        $stmt->execute(array('id' => $id));
        $tableresultat=$stmt->fetch();
        return $tableresultat;

    }
    
}