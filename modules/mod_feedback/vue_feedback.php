<?php
include_once "vue_generique.php";

class VueFeedback {
    public function afficherFormulaire() {
        echo '<form action="index.php?module=feedback&action=inserer" method="post">
                <label for="nom_utilisateur">Nom d\'utilisateur:</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                
                <label for="commentaire">Commentaire:</label>
                <textarea id="commentaire" name="commentaire" required></textarea><br>
                
                <input type="submit" value="Soumettre">
              </form>';
    }

    public function afficherFeedbacks($feedbacks) {
        echo '<div id="liste_feedbacks">';
        foreach ($feedbacks as $feedback) {
            echo '<div class="feedback">';
            echo '<h3>' . htmlspecialchars($feedback['nom_utilisateur']) . '</h3>';
            echo '<p>' . htmlspecialchars($feedback['commentaire']) . '</p>';
            echo '</div>';
        }
        echo '</div>';
    }
}

?>



?>