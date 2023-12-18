<?php
// Ce fichier s'occupera de l'affichage des données.
include_once "vue_generique.php";

class VueTours extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficherTours($elements) {
        ?>
        <head>
            <style>
                .popup {
                    display: none;
                    position: fixed;
                    width: 300px;
                    background: white;
                    padding: 20px;
                    border: 1px solid #ccc;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 1000;
                }

                .popup:target {
                    display: block;
                }

                .popup-content {
                    text-align: center;
                }

                .close {
                    cursor: pointer;
                    position: absolute;
                    right: 10px;
                    top: 5px;
                }
            </style>
        </head>
        <body>
        <?php
        if (empty($elements)) {
            echo "<p>Aucun élément à afficher</p>";
        } else {
            foreach ($elements as $element) {
                if (isset($element['id_tour'], $element['image'], $element['nom'], $element['degat'])) {
                    ?>
                    <div class="col">
                        <a href="#popup<?= htmlspecialchars($element['id_tour']) ?>">
                            <img src="<?= htmlspecialchars($element['image']) ?>" alt="Image du tour" width="100px"/>
                        </a>
                        <!-- Pop-up -->
                        <div id="popup<?= htmlspecialchars($element['id_tour']) ?>" class="popup">
                            <div class="popup-content">
                                <a href="#" class="close">&times;</a>
                                <p>Nom: <?= htmlspecialchars($element['nom']) ?></p>
                                <p>Dégâts: <?= htmlspecialchars($element['degat']) ?></p>
                                <!-- Ajoutez d'autres informations ici -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
        </body>
        <?php
    }

     

    public function afficherBarre() {
        ?>
        <div class="mx-auto p-2">
            <form action="index.php?module=tours&action=recherche" method="post">
                <input type="text" name="search" placeholder="Rechercher un tour par nom...">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <?php
    }

    public function afficherDetailsTour($tour) {
        if (isset($tour) && is_array($tour)) {
            ?>
            <div class="details-tour">
                <?php if (isset($tour['image'])): ?>
                    <img src="<?= htmlspecialchars($tour['image']) ?>" alt="Image de la tour">
                <?php endif; ?>

                <?php if (isset($tour['nom'])): ?>
                    <h3><?= htmlspecialchars($tour['nom']) ?></h3>
                <?php endif; ?>

                <?php if (isset($tour['degat'])): ?>
                    <p>Dégâts: <?= htmlspecialchars($tour['degat']) ?></p>
                <?php endif; ?>

            </div>
            <?php
        } else {
            echo "<p>Informations sur la tour non disponibles.</p>";
        }
    }

    public function afficherPopupTour($tour) {
        // Vérifier si les informations de la tour sont disponibles
        if (isset($tour['id_tour'])) {
            // Affichage des détails de la tour
            echo '<div class="popup">';
            echo 'Nom de la tour: ' . htmlspecialchars($tour['nom']) . '<br>';
            echo 'Prix: ' . htmlspecialchars($tour['prix']) . '<br>';
            echo 'Projectile: ' . htmlspecialchars($tour['projectile']) . '<br>';
            echo 'Dégât: ' . htmlspecialchars($tour['degat']) . '<br>';
    
            // Affichage de l'image de la tour
            if (isset($tour['image']) && file_exists($tour['image'])) {
                echo '<img src="' . htmlspecialchars($tour['image']) . '" alt="Image de la tour ' . htmlspecialchars($tour['nom']) . '"><br>';
            } else {
                echo 'Image non disponible.<br>';
            }
    
            echo '</div>';
        }
    }
    

    public function afficherPopupErreur($message) {
        echo '<div class="popup">' . $message . '</div>';
    }
    
}
?>
