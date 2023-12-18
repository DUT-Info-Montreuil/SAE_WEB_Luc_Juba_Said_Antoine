<?php
// Ce fichier s'occupera de l'affichage des données.
include_once "vue_generique.php";

class VueTours extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function afficherTours($elements)
    {
        ?>

        <head>
            <style>
               /* Styles pour le popup */
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

                /* Styles pour la barre de recherche */
                .search-bar {
                    text-align: center;
                    margin: 20px 0;
                }

                .search-bar input[type="text"] {
                    width: 50%;
                    padding: 5px;
                    margin-right: 10px;
                }

                /* Styles pour les cartes de tours */
                .cards-container {
                    display: flex;
                    flex-wrap: nowrap;
                    overflow-x: auto;
                }

                .card {
                    border: 1px solid #ccc;
                    padding: 15px;
                    margin: 10px;
                    width: 200px;
                    text-align: center;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                }

                .card img {
                    width: 100%;
                    height: auto;
                }
            </style>
        </head>

        <body>
            <?php
              if (empty($elements)) {
                echo "<p>Aucun élément à afficher</p>";
            } else {
                echo '<div class="cards-container">';
                foreach ($elements as $element) {
                    if (isset($element['id_tour'], $element['image'], $element['nom'], $element['degat'])) {
                        ?>
                        <div class="card">
                            <a href="#popup<?= htmlspecialchars($element['id_tour']) ?>">
                                <img src="<?= htmlspecialchars($element['image']) ?>" alt="Image du tour" />
                            </a>
                            <p>Nom: <?= htmlspecialchars($element['nom']) ?></p>
                            <p>Dégâts: <?= htmlspecialchars($element['degat']) ?></p>
                            <!-- Pop-up -->
                            <div id="popup<?= htmlspecialchars($element['id_tour']) ?>" class="popup">
                                <div class="popup-content">
                                    <a href="#" class="close">&times;</a>
                                    <p>Nom: <?= htmlspecialchars($element['nom']) ?></p>
                                    <p>Dégâts: <?= htmlspecialchars($element['degat']) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                echo '</div>';
            }
            ?>
        </body>
        <?php
    }




    public function afficherBarre()
    {
        ?>
        <div class="search-bar">
            <form action="index.php?module=tours&action=recherche" method="post">
                <input type="text" name="search" placeholder="Rechercher un tour par nom...">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <?php
    }

    public function afficherDetailsTour($tour)
    {
        if (isset($tour) && is_array($tour)) {
            ?>
            <div class="details-tour">
                <?php if (isset($tour['image'])): ?>
                    <img src="<?= htmlspecialchars($tour['image']) ?>" alt="Image de la tour">
                <?php endif; ?>

                <?php if (isset($tour['nom'])): ?>
                    <h3>
                        <?= htmlspecialchars($tour['nom']) ?>
                    </h3>
                <?php endif; ?> <!-- ... Styles CSS pour .popup, .card, etc. ... -->

                <?php if (isset($tour['degat'])): ?>
                    <p>Dégâts:
                        <?= htmlspecialchars($tour['degat']) ?>
                    </p>
                <?php endif; ?>

            </div>
            <?php
        } else {
            echo "<p>Informations sur la tour non disponibles.</p>";
        }
    }

    public function afficherPopupTour($tour)
    {
        // Vérifier si les informations de la tour sont disponibles
        if (isset($tour['id_tour'])) {
            // Affichage des détails de la tour
            echo '<div class="popup" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 1px solid #ddd; padding: 20px; background-color: white; z-index: 1000; text-align: center;">';  // Ajout de text-align: center
            echo 'Nom de la tour: ' . htmlspecialchars($tour['nom']) . '<br>';
            echo 'Prix: ' . htmlspecialchars($tour['prix']) . '<br>';
            echo 'Description: ' . htmlspecialchars($tour['description']) . '<br>';
            echo 'Dégât: ' . htmlspecialchars($tour['degat']) . '<br>';

            // Affichage de l'image de la tour
            if (isset($tour['image']) && file_exists($tour['image'])) {
                echo '<img src="' . htmlspecialchars($tour['image']) . '" alt="Image de la tour ' . htmlspecialchars($tour['nom']) . '" style="max-width: 100%; max-height: 300px; width: auto; height: auto;"><br>';
            } else {
                echo 'Image non disponible.<br>';
            }

            // Bouton de retour à la liste des tours, centré
            echo '<div style="text-align: center;">';
            echo '<button onclick="window.location.href=\'url_de_la_page_des_tours.php\'">Retour à la liste des tours</button>';
            echo '</div>';

            echo '</div>';
        }
    }





    public function afficherPopupErreur($message)
    {
        echo '<div class="popup">' . $message . '</div>';
    }

}
?>