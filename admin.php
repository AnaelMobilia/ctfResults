<?php
require 'config/config.php';

// Besoin du paramètre groupe en $_GET
if (!isset($_GET["pass"]) || $_GET["pass"] != _PASS_ADMIN) {
    header("Location: index.php");
    exit();
}

// Retour de l'exécution côté SQL
$etat;

// Gestion de l'envoi du formulaire
if (isset($_POST["submitEvt"])) {
    // Evenement sur un serveur
    $etat = updater::enregistrerEvt($_POST["groupe"], $_POST["evenement"]);
} elseif (isset($_POST["submitEtat"])) {
    // Changement d'état d'un serveur
    $etat = updater::changeStatut($_POST["groupe"]);
} elseif (isset($_POST["submitFlag"])) {
    $etat = updater::enregistrerFlag($_POST["groupe"], $_POST["flagType"], $_POST["flag"]);
}

// Chargement de la liste des groupes
$listeGroupes = loader::chargerGroupes();
// Tous les événements possibles en admin...
$listeEvts = loader::chargerTypeActions(false, true);
// Les flags...
$listeFlags = loader::chargerTypeActions(true, false);
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
                <?php if (isset($etat)): ?>
                    <div class="alert alert-<?= $etat ? "success" : "danger" ?> alert-dismissible fade show" role="alert">
                        <strong>Requête SQL</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <h1 class="display-5">Saisir un événement</h1>
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="groupe">Groupe</label>
                            <div class="col-sm-10">
                                <select id="groupe" name="groupe">
                                    <?php foreach ($listeGroupes as $unGroupe) : ?>
                                        <option value="<?= $unGroupe->getId() ?>"><?= $unGroupe->getMembres() ?> (<?= $unGroupe->getUrlServeur() ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="evenement">Evenement</label>
                            <div class="col-sm-10">
                                <select name="evenement" name="evenement">
                                    <?php foreach ($listeEvts as $unEvt) : ?>
                                        <option value="<?= $unEvt->getId() ?>"><?= $unEvt->getLibelle() ?> (<?= $unEvt->getValeur() ?> points)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="submitEvt" class="btn btn-primary" value="Envoyer" />
                    </form> 
                </div>
                <hr />
                <div class="container">
                    <h1 class="display-5">Modifier l'état d'un serveur</h1>
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="groupe">Groupe</label>
                            <div class="col-sm-10">
                                <select id="groupe" name="groupe">
                                    <?php foreach ($listeGroupes as $unGroupe) : ?>
                                        <option value="<?= $unGroupe->getId() ?>"><?= $unGroupe->getMembres() ?> (<?= $unGroupe->getUrlServeur() ?>) - <?= $unGroupe->getIsEnligne() ? "En" : "Hors" ?> ligne</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="submitEtat" class="btn btn-primary" value="Modifer" />
                    </form> 
                </div>
                <hr />
                <div class="container">
                    <h1 class="display-5">Enregistrer un flag</h1>
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="groupe">Groupe</label>
                            <div class="col-sm-10">
                                <select id="groupe" name="groupe">
                                    <?php foreach ($listeGroupes as $unGroupe) : ?>
                                        <option value="<?= $unGroupe->getId() ?>"><?= $unGroupe->getMembres() ?> (<?= $unGroupe->getUrlServeur() ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="flagType">Type de flag</label>
                            <div class="col-sm-10">
                                <select id="flagType" name="flagType">
                                    <?php foreach ($listeFlags as $unFlag) : ?>
                                        <option value="<?= $unFlag->getId() ?>"><?= $unFlag->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="flag">Valeur</label>
                            <div class="col-sm-10">
                                <input type="text" id="flag" name="flag" />
                            </div>
                        </div>
                        <input type="submit" name="submitFlag" class="btn btn-primary" value="Envoyer" />
                    </form> 
                </div>
            </div>
        </main>
        <footer class="text-muted">
            <div class="container">
                <p>Site réalisé par <a href="https://www.anael.eu">Anael MOBILIA</a></p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    </body>
</html>
