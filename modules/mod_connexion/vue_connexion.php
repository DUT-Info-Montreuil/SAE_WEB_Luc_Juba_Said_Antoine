<?php

include_once("vue_generique.php");

class VueConnexion extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }

    public function form_inscrire() {
        $token = CSRFToken::genererToken();
        ?>
            
        <div class="container d-flex justify-content-center align-items-center mt-5 rounded" style="width: 600px; height: 300px; background: #1B6CA6;">
            <div class="mx-auto p-2" style="width: 300px;">
                <h3 class="fw-bold"> S'inscrire </h3>

                <form action="index.php?module=connexion&action=inscrire" method="post">
                    <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Saisir login : </label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="nouveau login" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mot de passe : </label>
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder="mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmer</button>

                </form>

                <a class="link-light" href="index.php?module=connexion&action=form_connexion">Vous avez déjà un compte ? Se connecter </a>
            </div>
        </div>
        <?php
    }
 public function form_connexion() {  
    $token = CSRFToken::genererToken();
    ?>
    <div class="container d-flex justify-content-center align-items-center mt-5 rounded" style="width: 600px; height: 300px; background: #1B6CA6;">
        <div class="mx-auto p-2" style="width: 300px;">
            <h3 class="fw-bold"> Se connecter </h3>
            <form action="index.php?module=connexion&action=connexion" method="post">
                <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Saisir votre login : </label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="login" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mot de passe : </label>
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
            <a class="link-light" href="index.php?module=connexion&action=form_inscription">Vous inscrire ? </a>
        </div>
    </div>
    <?php
}

    public function deja_connecter() {
        ?>

        <div class="alert alert-info" role="alert">
            Vous êtes connecté sur le login : <?php echo htmlentities($_SESSION['login']['pseudo']); ?>
        </div>

        <?php
    }

    public function compte_existant() {
        ?>

        <div class="alert alert-warning" role="alert">
            Le compte avec le login : <?php echo htmlentities($_POST['login']); ?> existe déjà.
        </div>

        <?php
    }

    public function connexion_valide() {
        ?>

        <div class="alert alert-success" role="alert">
            Connexion réussite. 
        </div>

        <?php
    }

    public function inscription_valide() {
        ?>

        <div class="alert alert-success" role="alert">
            Inscription réussite. 
        </div>

        <?php
    }

    public function erreur_champs() {
        ?>

        <div class="alert alert-danger" role="alert">
            Échec :  les champs saisis sont erronés.
        </div>

        <?php
    }

    public function deconnexion_valide() {
        ?>

        <div class="alert alert-success" role="alert">
            Vous êtes déconnecter.
        </div>
        
        <?php
    }
}

?>