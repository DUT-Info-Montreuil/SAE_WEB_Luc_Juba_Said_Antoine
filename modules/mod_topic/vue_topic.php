<?php

include_once("vue_generique.php");

class VueTopic extends VueGenerique{

    public function __construct()
    {
        parent::__construct();
    }

    public function afficheFormTopic() {
        ?>
        <div class="container">
            <h1> Créer un topic :</h1>
            <form action="index.php?module=topic&action=creerTopic" method="post">
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
 
}

?>