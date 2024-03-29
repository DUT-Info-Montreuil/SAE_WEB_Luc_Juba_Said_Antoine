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
                        <p>Ennemis : <?php echo $moyenne['moyenne_ennemis']; ?></p>
                        <p>Ennemis tués : <?php echo $moyenne['moyenne_tuer']; ?></p>
                        <p>Tourelles posées : <?php echo $moyenne['moyenne_tours']; ?></p>
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="bg-success text-white rounded p-3 m-1">
                        <h2> Maximum </h2>
                        <p>Vague : <?php echo $max['max_vague']; ?></p>
                        <p>Ennemis : <?php echo $max['max_ennemis']; ?></p>
                        <p>Ennemis tués : <?php echo $max['max_tuer']; ?></p>
                        <p>Tourelles posées : <?php echo $max['max_tours']; ?></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="bg-danger text-white rounded p-3 m-1">
                        <h2> Minimum </h2>
                        <p>Vague : <?php echo $min['min_vague']; ?></p>
                        <p>Ennemis : <?php echo $min['min_ennemis']; ?></p>
                        <p>Ennemis tués : <?php echo $min['min_tuer']; ?></p>
                        <p>Tourelles posées : <?php echo $min['min_tours']; ?></p>
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
                    Vous n'avez aucune donnée de jeu enregistrée.
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
                        <li><button type="button" class="dropdown-item" id="nombre-tours">Nombre de tourelles posées</button></li>
                        <li><button type="button" class="dropdown-item" id="score">Score</button></li>
                    </ul>
                </div>
            </div>
            <div class="container text-center mt-4" style="width: 60%;">
                <canvas id="myChart" style="height: 400px; background-color: #f0f0f0;"></canvas>
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
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Classement des Joueurs</h1>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="dropdown text-center">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtre Classement
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?module=joueur&action=vague">Vague</a></li>
                            <li><a class="dropdown-item" href="index.php?module=joueur&action=score">Score</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
    }


    public function profil($joueur)
    {
        $token = CSRFToken::genererToken();
        ?>
        <body>
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <h1 class="text-center" style="background: #1B6CA6;">Profil Utilisateur</h1>
                        <form action="index.php?module=joueur&action=sauvegarde" method="post" enctype="multipart/form-data" class="mt-4">
                            <input type="hidden" name="<?php echo CSRFToken::getTokenName(); ?>" value="<?php echo $token; ?>">
                            <div class="mb-3"  style="background: #1B6CA6;">
                                <label for="username" class="form-label" >Pseudo utilisateur :</label>
                                <p><?php echo htmlspecialchars($joueur[0]["pseudo"]); ?></p>
                            </div>
    
                            <div class="text-center mb-3"  style="background: #1B6CA6;">
                                <label for="profile_pic" class="form-label">Photo de profil :</label><br>
                                
                                <img src="<?php echo htmlspecialchars($joueur[0]['photo_de_profile']); ?>" class="img-fluid rounded-circle mb-3" alt="image" style="width: 150px; height: 150px; object-fit: cover;">
                                <div>
                                    <label class="btn btn-primary" for="inputGroupFile01">Modifier</label>
                                    <input type="file" class="form-control" id="inputGroupFile01" name="inputGroupFile01" style="display: none" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
    
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe :</label>
                                <input type="text" disabled class="form-control" id="password" name="password" value="***********">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">modifier</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content text-black">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CONFIRMATION</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Vous êtes sur le point de modifier votre mot de passe, êtes-vous certain de vouloir le faire?  
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">QUITTER</button>
                                                    <button type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle2"
                                                        data-bs-toggle="modal">OUI</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content text-black">
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
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">QUITTER</button>
                                                    <input type="submit" class="btn btn-primary" name="modifierMot_De_Passe" value="Sauvegarder">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                </div>
    
                            <div class="mb-3">
                                <label for="description" class="form-label">Description :</label>
                                <textarea class="form-control" disabled id="description" name="description"><?php echo htmlspecialchars($joueur[0]["description"]); ?></textarea>
                            </div>
    
                            <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Sauvegarder</button>
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-black">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">CONFIRMATION</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment sauvegarder les modifications que vous avez apportées sur votre page profil ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">QUITTER</button>
                                            <input type="submit" class="btn btn-primary" value="Sauvegarder">
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
        <?php
    }
    
            public function affiche3Classement($joueurs)
                {
                    ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 text-center">
                                <h2>Top 3 Classement</h2>
                                <ul class="list-group">
                                    <?php
                                    $nombreAffiche = 0;
                                    foreach ($joueurs as $j) {
                                        if ($nombreAffiche < 3) {
                                            echo "<li class='list-group-item'> nom : " . htmlspecialchars($j['pseudo']) . "   score :" . htmlspecialchars($j['max_value']) . "</li>";
                                            $nombreAffiche++;
                                        }
                                    }
                                    ?>
                                </ul>
                                <a href='index.php?module=joueur&action=affichePlusClassement' class='btn btn-primary mt-3'>Afficher Plus</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }

        public function afficheClassement($joueurs)
        {
            ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 text-center">
                        <h2>Classement Complet</h2>
                        <ul class="list-group">
                            <?php
                            foreach ($joueurs as $j) {
                                echo "<li class='list-group-item'> nom : " . htmlspecialchars($j['pseudo']) . "   score :" . htmlspecialchars($j['max_value']) . "</li>";
                            }
                            ?>
                        </ul>
                        <a href='index.php' class='btn btn-primary mt-3'>Quitter</a>
                    </div>
                </div>
            </div>
            <?php
        }

}


?>