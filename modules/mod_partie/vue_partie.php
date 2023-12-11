<?php

include_once("vue_generique.php");

class VuePartie extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }

    public function affiche_partie($tab) {
        ?> 
        <div class="d-flex flex-column align-items-center">
        <h1 class="text-center"> Historique des parties : </h1>
        <br>
            <?php 
            foreach($tab as $values) { 
                ?>
                <div class="list-group">
                    <a href="index.php?module=partie&action=details&id=<?php echo $values['id_partie'];?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Partie du : </h5>
                        <small class="text-body-secondary"> <?php echo $values['date']; ?> </small>
                        </div>
                        <p class="mb-1"> Cliquez pour voir le détail de la partie.</p>
                    </a>
                    </div>
                <?php
            } 
            ?>
    </div>
    <?php
    }
}

?>