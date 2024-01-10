<?php
include_once "vue_generique.php";

class VueFeedback {
    public function afficherFormulaire() {
        echo '<style>';
        echo $this->obtenirCSS();
        echo '</style>';

        echo '<form action="index.php?module=feedback&action=inserer" method="post" class="form-feedback">
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

    private function obtenirCSS() {
        return "
            /* Style général du formulaire */
            .form-feedback {
                background-color: #f2f2f2;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: auto;
            }

            /* Style des labels */
            .form-feedback label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            /* Style des inputs et textareas */
            .form-feedback input[type='text'],
            .form-feedback input[type='email'],
            .form-feedback textarea {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }

            /* Style du bouton submit */
            .form-feedback input[type='submit'] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            .form-feedback input[type='submit']:hover {
                background-color: #45a049;
            }

            /* Style des feedbacks affichés */
            #liste_feedbacks .feedback {
                background-color: #e9e9e9;
                padding: 15px;
                margin-top: 10px;
                border-radius: 5px;
            }

            #liste_feedbacks .feedback h3 {
                margin-top: 0;
            }

            #liste_feedbacks .feedback p {
                margin-bottom: 0;
            }
        ";
    }
}
?>
