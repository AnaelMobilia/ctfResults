<?php
require 'config/config.php';

// Besoin du paramètre groupe en $_GET
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

// Chargement de la liste des evenements de la machine
$listeEvts = loader::chargerEvenementsMachine($_GET["id"]);
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
            <a class="navbar-brand" href="index.php">CTF - Résultats</a>
        </nav>
        <main role="main">
            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-5">Evenements pour le serveur de <?= loader::getNomGroupe($_GET["id"]) ?></h1>
                    <table class="table table-hover" id="resultats">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Evénement</th>
                                <th scope="col">Par</th>
                                <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listeEvts as $unEvt) : ?>
                                <tr>
                                    <td><?= date('d/m/Y H:i', $unEvt->getTimestamp()) ?></td>
                                    <td><?= $unEvt->getNom() ?></td>
                                    <td><?= $unEvt->getNomGroupe() ?></td>
                                    <td><?= $unEvt->getValeur() ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
        <script>
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
