if (window.location.href.indexOf('index.php?module=joueur') > -1) {
    $(document).ready(function() {

        $.ajax({
            url: 'index.php?module=joueur&action=moyenneTuer',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const labels = data.statGlobale.map(entry => entry.mois);
                const dataGlobal = data.statGlobale.map(entry => entry.Moyenne_tuer);

                const labelJoueur = data.statJoueur.map(entry => entry.mois);
                const dataJoueur = data.statJoueur.map(entry => entry.Moyenne_tuer_joueur);

                const nom = data.nom;

                updateChart(labels, dataGlobal, labelJoueur, dataJoueur,nom);
            },
            error: function(error) {
                console.log('Erreur lors de la récupération des données : ', error);
            }
        });

        function updateChart(labels, dataGlobal, labelJoueur, dataJoueur,nom) {
            const ctx = document.getElementById('myChart');

            if (ctx) {
                const chart = new Chart(ctx, {
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
                                text: nom
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
