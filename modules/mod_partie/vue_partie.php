<?php

include_once("vue_generique.php");

class VuePartie extends VueGenerique {

    public function __construct(){
        parent::__construct();
    }

    public function affiche_partie($tab) {

        ?> 
        <div class="d-flex justify-content-center">
            <ol class="list-group list-group-numbered">
            <?php 
            foreach($tab as $values) { 
                echo "<p> Id : " . $values['id_partie'] . "</p>";
                echo "<p> Nombre vague : " . $values['nombre_vague'] . "</p>";
                echo "<p> Ennemis tuer : " . $values['ennemis_tuer'] . "</p";
                echo "<p> Nombre ennemis : " . $values['nombre_ennemis'] . "</p>";
            } 
            ?>
            </ol>
        </div>
        <?php
    }
}

?>