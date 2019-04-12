<?php

// BDD
define('_BDD_HOST_', '127.0.0.1');
define('_BDD_USER_', 'root');
define('_BDD_PASS_', '');
define('_BDD_NAME_', 'myctf');

// Chemin sur le système de fichier
define('_PATH_', __DIR__ . '/../');

// Mot de passe d'administration
define('_PASS_ADMIN', 'password');

// Fonction de chargement des classes en cas de besoin
spl_autoload_register(function ($class) {
    require _PATH_ . 'classes/' . $class . '.class.php';
});
