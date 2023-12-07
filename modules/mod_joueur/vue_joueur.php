<?php

include_once("vue_generique.php");

class VueJoueur extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }


    public function afficheClassement($joueurs){

    ?>
        <body>
            <h1>Classement des Joueurs</h1>
             
           <?php 
           
           foreach ($joueurs as $j){
                 echo  "<br>".$j['id_partie']."  ".$j['score']; 
           }

           ?>

        </body>

    <?php
}

}




?>