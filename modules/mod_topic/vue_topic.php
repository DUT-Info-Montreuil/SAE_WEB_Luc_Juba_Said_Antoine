<?php

include_once("vue_generique.php");

class VueTopic extends VueGenerique{

    public function __construct()
    {
        parent::__construct();
    }

    public function afficheFormTopic() {
        $token = CSRFToken::genererToken();
        ?>
        <div class="container">
            <h1> Créer un topic :</h1>
            <form action="index.php?module=topic&action=creerTopic" method="post">
            <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">  <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                <div class="mb-3">
                    <label for="questionId" class="form-label">Question :</label>
                    <input type="text" class="form-control" id="questionId" name="question" placeholder="Saisir votre question" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="descriptif" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
        <?php
    }

    public function afficheListeTopic($tab, $count) {
        ?>
        <div class="container d-flex flex-column align-items-center mt-5">
            <?php if(isset($_SESSION['login'])) { ?>
                <div>
                    <p>Créer un topic : <a class="btn btn-primary" href="index.php?module=topic&action=affiche_form" role="button">Nouveau Topic</a></p>
                </div>
            <?php } ?>
            <div class="card" style="width: 32rem; max-height : 350px; overflow-y : auto;">
                <div class="card-header">
                    Topics disponibles :
                </div>
                <ol class="list-group list-group-numbered">
                    <?php
                    foreach ($tab as $value) {
                        ?>
                        <a href="index.php?module=topic&action=topic&id=<?php echo $value['id_topic']; ?>" class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">
                                    <?php echo $value['question']; ?>
                                </div>
                                <span>Créé par : <?php echo $value['pseudo']; ?> </span>
                                <br>
                                <span>Le : <?php echo $value['dateTopic']; ?> </span>
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                <?php echo $count->countMessageTopic($value['id_topic'])['nombre']; ?>
                            </span>
                        </a>
                        <?php
                    }
                    ?>
                </ol>
            </div>
        </div>
        <?php
    }
    

    public function affiche_topic($topic, $tab) {
        ?>
        <div class="container d-flex flex-column align-items-center mt-5">
            <h3>Sujet : <?php echo $topic['question']; ?> </h3>
            <div class="card  text-bg-secondary mb-3" style="width: 50%;">
                    <p class="card-header">
                        <span> Créateur du topic : </span>
                        <img src="<?php echo $topic['photo_de_profile']; ?>" class="rounded-circle img-fluid border border-black" alt="img" style="max-width: 35px;"> 
                        <span>  <?php echo $topic['pseudo']; ?> </span>
                    </p>
                    <div class="card-body">
                        <p class="card-text"> <?php echo $topic['intituler']; ?> </p>
                    </div>
                </div>
            <?php
            $this->liste_commentaire($tab);
            $this->insertCommentaire();
            ?>
        </div>
        <?php
    }
    
    public function liste_commentaire($tab) {
        ?>
        <div class="container mt-4 d-flex flex-column align-items-center">
            <?php foreach($tab as $value): ?>
                <div class="card mb-3" style="width: 50%;">
                    <p class="card-header">
                        <img src="<?php echo $value['photo_de_profile']; ?>" class="rounded-circle img-fluid border border-black" alt="img" style="max-width: 35px;"> 
                        <span> <?php echo $value['pseudo']; ?> </span>
                        <span>poster le <?php echo $value['dateMessage']; ?> </span>
                        <span>à <?php echo $value['heureMessage']; ?> </span>
                        <?php
                            if(isset($_SESSION['login']) && $value['id_utilisateur']==$_SESSION['login']['id_u'] || $_SESSION['login']['id_r'] == 2) {
                                ?>
                                <?php echo $this->menuCommentaire($value['id_message']); ?>
                                <?php
                            }
                        ?>
                    </p>
                    <div class="card-body">
                        <p class="card-text"><?= $value['contenu'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
    
    public function insertCommentaire() {
        if(isset($_SESSION['login'])) {
            $token = CSRFToken::genererToken();
            ?>
            <form id="commentForm" action="index.php?module=topic&action=insertCom" method="post">
                  <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                <div class="mb-3" style="width: 350px;">
                    <label for="exampleFormControlTextarea1" class="form-label">Saisir votre commentaire :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="com" rows="3" required placeholder="votre commentaire ..."></textarea>
                    <input type="hidden" name="id_topic" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-primary" id="envoyerCom">Envoyer</button>
                </div>
            </form>
            <?php
        }else {
            ?>
                <div class="mb-3" style="width: 350px;">
                    <label for="exampleFormControlTextarea1" class="form-label">Saisir votre commentaire :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Vous n'avez pas de compte !</textarea>
                    <a href="index.php?module=connexion&action=form_inscription">Cliquez pour créer un compte.</a>
                </div>
            <?php
        }
    }

    public function menuCommentaire($id) {
        $deleteModalId = "deleteModal_" . $id;
        $token = CSRFToken::genererToken();
        ?>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/pencil-square.svg" alt="Instagram" class="img-fluid"> 
            </a>
    
            <ul class="dropdown-menu">
                <li>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $deleteModalId; ?>">
                        Supprimer
                    </button>
                </li>
            </ul>
        </div>
    
        <div class="modal fade" id="<?php echo $deleteModalId; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?php echo $deleteModalId; ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                        <h1 class="modal-title fs-5" id="<?php echo $deleteModalId; ?>Label">Suppression   <img src="assets/exclamation-triangle-fill.svg" alt="Warning" class="img-fluid">  </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            Etes-vous sûr de supprimer votre commentaire ? 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="deleteComment_<?php echo $id; ?>">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    
}

?>