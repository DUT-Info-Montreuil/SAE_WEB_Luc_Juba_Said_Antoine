<?php

include_once("vue_generique.php");

class VueJoueur extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }

    public function affiche_stat($moyenne,$max,$min) {
        ?>
        <div class="container text-center mt-4">
            <div class="row justify-content-center">
    
                <div class="mb-4">
                    <h1 class="text-decoration-underline">Vos statistiques</h1>
                    <img src="assets/graph-up-arrow.svg" alt="Graph" class="img-fluid">
                </div>
    
                <div class="col-md-4">
                    <div class="bg-primary text-white rounded p-3 m-1">
                        <h2> Moyenne </h2>
                        <p>Vague : <?php echo $moyenne['moyenne_vague']; ?></p>
                        <p>Ennemis : <?php echo $moyenne['moyenne_tuer']; ?></p>
                        <p>Ennemis tué : <?php echo $moyenne['moyenne_ennemis']; ?></p>
                        <p>Tourelles posé : <?php echo $moyenne['moyenne_tours']; ?></p>
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="bg-success text-white rounded p-3 m-1">
                        <h2> Maximum </h2>
                        <p>Vague : <?php echo $max['max_vague']; ?></p>
                        <p>Ennemis : <?php echo $max['max_tuer']; ?></p>
                        <p>Ennemis tué : <?php echo $max['max_ennemis']; ?></p>
                        <p>Tourelles posé : <?php echo $max['max_tours']; ?></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bg-danger text-white rounded p-3 m-1">
                        <h2> Minimum </h2>
                        <p>Vague : <?php echo $min['min_vague']; ?></p>
                        <p>Ennemis : <?php echo $min['min_tuer']; ?></p>
                        <p>Ennemis tué : <?php echo $min['min_ennemis']; ?></p>
                        <p>Tourelles posé : <?php echo $min['min_tours']; ?></p>
                    </div>
                </div>
    
            </div>
        </div>
        <?php
        $this->affiche_graph();
    }

    public function affiche_sans_stat() {
        ?>
            <div class="text-center m-5">
                <div class="alert alert-info" role="alert">
                    Vous n'avez aucune donnée de jeu enregistrer.
                </div>
            </div>
        <?php
    }

    public function affiche_graph() {
        ?>
            <div class="text-center m-5">
                <h1>Graphique :</h1>
                <div class="dropdown m-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Choisir
                    </button>
                    <ul class="dropdown-menu ">
                        <li><button type="button" class="dropdown-item" id="ennemis-tues">Ennemis tués</button></li>
                        <li><button type="button" class="dropdown-item" id="nombre-vague">Nombre de vagues</button></li>
                        <li><button type="button" class="dropdown-item" id="nombre-tours">Nombre de tourelles posé</button></li>
                        <li><button type="button" class="dropdown-item" id="score">Score</button></li>
                    </ul>
                </div>
            </div>
            <div class="container text-center mt-4" style="width: 60%;">
                <canvas id="myChart" style="height: 400px;"></canvas>
            </div>
            <?php $this->choix_Graph(); ?>
        <?php
       
    }

    public function choix_Graph() {
        ?>
            <div class="text-center m-5">
                <p> Type de graphique : </p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="barre" value="option1" checked>
                    <label class="form-check-label" for="inlineRadio1">Barre</label>
                </div>
                <div class="form-check form-check-inline">   
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ligne" value="option2"> 
                    <label class="form-check-label" for="inlineRadio2">Ligne</label>
                </div>
            </div>
        <?php
    }

    public function filtreClassement()
    {
        ?>
        <h1>Classement des Joueurs</h1>
        <div class="dropdown">
            <a class="btn btn-info dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                filtre Classement
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?module=joueur&action=vague">vague</a></li>
                <li><a class="dropdown-item" href="index.php?module=joueur&action=score">score</a></li>
            </ul>
        </div>
        <?php
    }

    public function profil($joueur)
    {
        ?>

        <body>

            <h1>Profil Utilisateur</h1>

            <form action="index.php?module=joueur&action=sauvegarde" method="post" enctype="multipart/form-data">
                <label for="username">Pseudo d’utilisateur : </label> <br>
                <?php echo $joueur[0]["pseudo"]; ?>
                <br>
                <br>
                <label for="profile_pic">Photo de profile :</label><br>

                <img src="<?php echo $joueur[0]['photo_de_profile']; ?>" class="img-thumbnail" alt="image">
                <div class="input-group mb-3">
                    <label class="btn btn-primary" for="inputGroupFile01">Modifier</label>
                    <input type="file" class="form-control" id="inputGroupFile01" name="inputGroupFile01" style="display: none" accept=".png, .jpg, .jpeg">
                </div>
                <br>

                <label for="password">Mot de passe :</label><br>
                <input type="texte" disabled id="password" name="password" value="******">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">modifier</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">CONFIRMATION</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Vous etes sur le point de modifier votre passe, ete vous sur de vouloir le faire ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">QUITTER</button>
                                <button type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle2"
                                    data-bs-toggle="modal">OUI</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modifier mon Mot de Passe</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputPassword" class="form-label">Ancien Mot de Passe </label>
                                    <input type="password" class="form-control" id="exampleInputPassword"
                                        name="exampleInputPassword">
                                    <label for="exampleInputPassword1" class="form-label">Nouveau Mot de Passe</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        name="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">QUITTER</button>
                                <input type="submit" class="btn btn-primary" name="modifierMot_De_Passe" value="Sauvegarder">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <label for="description">Description :</label><br>
                <textarea id="description" disabled name="description"
                    value="<?php echo $joueur[0]["description"] ?>"></textarea><br><br>

         
                <a href="index.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">QUITTER</button></a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Sauvegarder</button>
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">CONFIRMATION</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Voulez vous vraiment sauvegarder les modifications que vous avez apporté sur votre page profile
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">QUITTER</button>
                                <input type="submit" class="btn btn-primary" value="Sauvegarder">
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </body>

        <?php
    }

    public function affiche3Classement($joueurs)
    {
        $nombreAffiche = 0;

        foreach ($joueurs as $j) {
            if ($nombreAffiche < 3) {
                echo $j['pseudo'] . "  " . $j['max_value'] . "<br>";
                $nombreAffiche++;
            }
        }
        echo "<a href='index.php?module=joueur&action=affichePlusClassement' class='btn btn-primary'>Afficher Plus</a>";
    }

    public function afficheClassement($joueurs)
    {

        foreach ($joueurs as $j) {
            echo "<br>" . $j['pseudo'] . "  " . $j['max_value'];
        }
        echo "<br> <a href='index.php' class='btn btn-primary'>Quitter</a>";
    }

}


?>