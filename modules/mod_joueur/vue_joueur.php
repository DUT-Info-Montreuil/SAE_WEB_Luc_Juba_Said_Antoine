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

        <a href="index.php?module=classement&action=score">score</a>
        <br>
        <a href="index.php?module=classement&action=vague">vague</a>
        <?php

    }


    public function afficheClassement($joueurs)
    {
        foreach ($joueurs as $j) {
            echo "<br>" . $j['pseudo'] . "  " . $j['max_value'];
        }
    }

}


?>