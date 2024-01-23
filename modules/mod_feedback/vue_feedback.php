<?php
include_once "vue_generique.php";

class VueFeedback extends VueGenerique {
    
    public function afficherFormulaire() {
?>
        <link rel="stylesheet" href="styles.css">
        
        <form action="index.php?module=feedback&action=inserer" method="post" class="form-feedback">
            <label for="nom_utilisateur">Nom d'utilisateur:</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="commentaire">Commentaire:</label>
            <textarea id="commentaire" name="commentaire" required></textarea><br>
            
            <input type="submit" value="Soumettre">
        </form>
<?php
    }

    public function afficherFeedbacks($feedbacks) {
?>
        <div id="liste_feedbacks">
<?php
        foreach ($feedbacks as $feedback) {
?>
            <div class="feedback">
                <h3><?php echo htmlspecialchars($feedback['nom_utilisateur']); ?></h3>
                <p><?php echo htmlspecialchars($feedback['commentaire']); ?></p>
            </div>
<?php
        }
?>
        </div>
<?php
    }
}
?>
