if (window.location.href.indexOf('index.php?module=joueur') > -1) {
    $(document).ready(function() {

        let myChart = null;

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

        function afficheGraph(type) {
            $.ajax({
                url: 'index.php?module=joueur&action=moyenne',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const labels = data.statGlobale.map(entry => entry.mois);
                    let dataGlobal, dataJoueur,titre;

                    if (type === 'Moyenne_tuer') {
                        dataGlobal = data.statGlobale.map(entry => entry.Moyenne_tuer);
                        dataJoueur = data.statJoueur.map(entry => entry.Moyenne_tuer_joueur);
                        titre = "Moyenne des ennemis tué";
                    } else if (type === 'Moyenne_vague') {
                        dataGlobal = data.statGlobale.map(entry => entry.Moyenne_vague);
                        dataJoueur = data.statJoueur.map(entry => entry.Moyenne_vague_joueur);
                        titre = "Moyenne des vagues";
                    }else if (type === 'Moyenne_tour') {
                        dataGlobal = data.statGlobale.map(entry => entry.Moyenne_tours);
                        dataJoueur = data.statJoueur.map(entry => entry.Moyenne_tours_joueur);
                        titre = "Moyenne des tours posé";
                    }else if (type === 'Moyenne_score') {
                        dataGlobal = data.statGlobale.map(entry => entry.Moyenne_score);
                        dataJoueur = data.statJoueur.map(entry => entry.Moyenne_score_joueur);
                        titre = "Moyenne des scores";
                    }

                    updateChart(labels, dataGlobal, dataJoueur, titre);
                },
                error: function(error) {
                    console.log('Erreur lors de la récupération des données : ', error);
                }
            });
        }

        function updateChart(labels, dataGlobal, dataJoueur,titre) {
            const ctx = document.getElementById('myChart');

            if (ctx) {
                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart(ctx, {
                    type: 'bar',
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