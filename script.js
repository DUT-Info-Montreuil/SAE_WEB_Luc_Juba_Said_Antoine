if (window.location.href.indexOf('index.php?module=joueur') > -1) {
    $(document).ready(function() {

        let myChart = null;
        let labels, dataGlobal, dataJoueur, titre;
        let typeGraph = "bar";

        afficheGraph('Moyenne_tuer');

        $('#ennemis-tues').on('click', function() {
            afficheGraph('Moyenne_tuer');
        });

        $('#nombre-vague').on('click', function() {
            afficheGraph('Moyenne_vague');
        });

        $('#nombre-tours').on('click', function() {
            afficheGraph('Moyenne_tour');
        });

        $('#score').on('click', function() {
            afficheGraph('Moyenne_score');
        });

        $('#barre').on('change', function(e) {
            e.preventDefault();
            typeGraph = "bar";
            updateChart();
        });

        $('#ligne').on('change', function(e) {
            e.preventDefault();
            typeGraph = "line";
            updateChart();
        });

        function afficheGraph(type) {
            $.ajax({
                url: 'index.php?module=joueur&action=moyenne',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    labels = data.statGlobale.map(entry => entry.mois);

                    switch (type) {
                        case 'Moyenne_tuer':
                            dataGlobal = data.statGlobale.map(entry => entry.Moyenne_tuer);
                            dataJoueur = data.statJoueur.map(entry => entry.Moyenne_tuer_joueur);
                            titre = "Moyenne des ennemis tués";
                            break;
                        case 'Moyenne_vague':
                            dataGlobal = data.statGlobale.map(entry => entry.Moyenne_vague);
                            dataJoueur = data.statJoueur.map(entry => entry.Moyenne_vague_joueur);
                            titre = "Moyenne des vagues";
                            break;
                        case 'Moyenne_tour':
                            dataGlobal = data.statGlobale.map(entry => entry.Moyenne_tours);
                            dataJoueur = data.statJoueur.map(entry => entry.Moyenne_tours_joueur);
                            titre = "Moyenne des tours posés";
                            break;
                        case 'Moyenne_score':
                            dataGlobal = data.statGlobale.map(entry => entry.Moyenne_score);
                            dataJoueur = data.statJoueur.map(entry => entry.Moyenne_score_joueur);
                            titre = "Moyenne des scores";
                            break;
                        default:
                            break;
                    }
                    updateChart();
                },
                error: function(error) {
                    console.log('Erreur lors de la récupération des données : ', error);
                }
            });
        }

        function updateChart() {
            const ctx = document.getElementById('myChart');

            if (ctx) {
                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart(ctx, {
                    type: typeGraph,
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Moyenne Globale',
                                data: dataGlobal,
                                borderWidth: 1
                            },
                            {
                                label: 'Moyenne du Joueur',
                                data: dataJoueur,
                                borderWidth: 1
                            },
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: titre
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        }
    });
}

if (window.location.href.indexOf('index.php?module=admin') > -1) {
    $(function() {

        function updateTableUtilisateurs() {
           $.ajax({
            type: "GET",
            url: "index.php?module=admin&action=getUtilisateurs",
            success: function (response) {
                $("#tableUtilisateurs").html(response);
                suppUtilisateur() 
            }
           });
        }

        function suppUtilisateur() { 
            $("[id^='delete']").click(function() {
                let userId = $(this).data("user-id");
                $.ajax({
                    type: "DELETE",
                    url: "index.php?module=admin&action=supprimer",
                    data: JSON.stringify({ id: userId }),
                    success: function (response) {
                        $("#staticBackdrop-" + userId).modal('hide');
                        updateTableUtilisateurs();
                    }
                });
            });
        }

        $("#searchInput").on('input', function() {
            let searchInputValue = $(this).val();

            $.ajax({
                type: "POST",
                url: "index.php?module=admin&action=rechercher",
                data: { recherche: searchInputValue },
                success: function (response) {
                    $("#tableUtilisateurs").html(response);
                    suppUtilisateur();
                }
            });
        });

        suppUtilisateur();
    });
}

if (window.location.href.indexOf('index.php?module=topic') > -1) {
    $(function() {

        function suppCommentaire(commentId) {
            $.ajax({
                type: "POST",
                url: "index.php?module=topic&action=supprimerCom",
                data: JSON.stringify({ id: commentId }),
                success: function (response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        }

        $("[id^='deleteComment']").click(function() {
            let commentId = $(this).attr("id").split("_")[1];
            suppCommentaire(commentId);
        });

        $("#envoyerCom").click(function(e) {
            e.preventDefault();
            var formData = $("#commentForm").serialize();
            $.ajax({
                type: "POST",
                url: "index.php?module=topic&action=insertCom",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert("Problème lors de l'insertion du commentaire : " + response.message);
                    }
                }
            });
        });
    });
}