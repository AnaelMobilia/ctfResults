<?php
require 'config/config.php';

// Chargement de la liste des groupes
$listeGroupe = loader::chargerGroupes();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>CTF</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">CTF - Résultats</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="soumissionFlag.php">Soumettre un flag</a>
                </li>
            </ul>
        </nav>
        <main role="main">
            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-5">Tableau des scores</h1>
                    <table class="table table-hover" id="resultats">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Rang</th>
                                <th scope="col">Machine</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Score</th>
                                <th scope="col">En ligne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listeGroupe as $unGroupe) : ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td><a href="evenementServeur.php?id=<?= $unGroupe->getId() ?>">
                                            <?= $unGroupe->getUrlServeur() ?>
                                        </a></td>
                                    <td><?= $unGroupe->getMembres() ?></td>
                                    <td class="score">
                                        <a href="scoreGroupe.php?id=<?= $unGroupe->getId() ?>">
                                            <?= $unGroupe->getScore() ?>
                                        </a>
                                    </td>
                                    <td><?= $unGroupe->getIsEnligne() ? "✓" : "✗" ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pour le calcul des rangs -->
                    <span class="hide" id="rang"></span>
                </div>
            </div> <!-- /container -->
        </main>
        <footer class="text-muted">
            <div class="container">
                <p>Site réalisé par <a href="https://www.anael.eu">Anael MOBILIA</a></p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script>
            // Calcul du rang
            $(function () {
                // Get all total values, sort
                let totalList = $(".score")
                        .map(function () {
                            return $(this).text().trim();
                        })
                        .get()
                        .sort(function (a, b) {
                            return b - a;
                        });

                //Assign rank
                totalList.forEach((v, i) => {
                    // Est-ce qu'on a déjà eu cette valeur ?            
                    if ($("#rang").val() !== v) {
                        place = i + 1;
                        // On met à jour le score actuel
                        $("#rang").val(v);
                    }
                    // Mise à jour de la case classement...
                    $('.score').filter(function () {
                        return $(this).text().trim() === v;
                    }).prev().prev().prev().text(place);
                });
            });

            // Tri du tableau....
            $(document).ready(function () {
                $('#resultats').DataTable({
                    paging: false,
                    searching: false,
                    info: false
                });
            });
        </script>
    </body>
</html>
