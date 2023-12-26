<?php

include_once("vue_generique.php");

class VueJoueur extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
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

    public function profil($joueur){     
        ?>  

          <body>

            <h1>Profil Utilisateur</h1>

            <form action="index.php?module=joueur&action=sauvegarde.php" method="post">
                <label for="username">Pseudo d’utilisateur : </label><?php echo $joueur[0]["pseudo"];?>
                <br> 
                <br>               
                <label for="profile_pic">Photo de profil :</label><br>
                <img src="<?= htmlspecialchars($joueur[0]['photo_de_profile'])?>" class="img-fluid rounded-start" alt="image">
                <div class="input-group mb-3">
                    <label class="btn btn-primary" for="inputGroupFile01">Modifier</label>
                    <input type="file" class="form-control" id="inputGroupFile01" style="display: none" accept=".png, .jpg, .jpeg">                    </div>
                <label for="password">Mot de passe :</label><br>
                <input type="texte" disabled id="password" name="password" value="******"> 
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    modifier
                    </button>
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
                                    <button type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">OUI</button>
                                </div>
                                </div>                       
                            </div>
                            </div>

                            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modifier mon Mot de Passe</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="mb-3">
                                                <label for="exampleInputPassword" class="form-label">Ancien Mot de Passe </label>
                                                <input type="password" class="form-control" id="exampleInputPassword" name = "exampleInputPassword">                    
                                                <label for="exampleInputPassword1" class="form-label">Nouveau Mot de Passe</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" name = "exampleInputPassword1">
                                   </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">QUITTER</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">CONTINUER</button>
                                </div>
                                    </div>
                                </div>
                                </div>
                <br>         
                <br>
                <label for="description">Description :</label><br>
                <textarea id="description" disabled name="description" value = "<?php echo $joueur[0]["description"] ?>"></textarea><br><br>
                <a href="index.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">QUITTER</button></a>
                <input type="submit" class="btn btn-primary" value="Sauvegarder">
            </form>

            </body>

        <?php
    }

    public function affiche3Classement($joueurs)
    {
        $nombreAffiche = 0;
            
        foreach ($joueurs as $j) {
            if ($nombreAffiche < 3) {
                echo $j['pseudo'] . "  " . $j['max_value']."<br>";
                $nombreAffiche++;
            } 
        }
            echo "<a href='index.php?module=joueur&action=affichePlusClassement' class='btn btn-primary'>Afficher Plus</a>";
    }

    public function afficheClassement($joueurs){
    
        foreach ($joueurs as $j) {
            echo "<br>" . $j['pseudo'] . "  " . $j['max_value'];
        }
    
        echo "<br> <a href='index.php' class='btn btn-primary'>Quitter</a>";
    }

}


?>