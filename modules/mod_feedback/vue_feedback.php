<?php
include_once "vue_generique.php";

class VueFeedback extends VueGenerique
{

    public function afficherFormulaire($pseudo){
    ?>
        <div class="container mt-5 text-black">
            <form action="index.php?module=feedback&action=inserer" method="post" class="form-feedback">
                <label for="nom_utilisateur">Nom d'utilisateur:</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?php echo $pseudo['pseudo']; ?>" disabled><br>
                
                <label for=" email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="commentaire">Commentaire:</label>
                <textarea id="commentaire" name="commentaire" required></textarea><br>

                <input type="submit" value="Soumettre">
            </form>   
        </div>
    <?php
    }

  
}
?>