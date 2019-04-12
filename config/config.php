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

// Recaptcha
define('_RECATCHA_PUBLIC_KEY_', '');
define('_RECATCHA_PRIVATE_KEY_', '');

// ======================================================
// Fonction de chargement des classes en cas de besoin
spl_autoload_register(function ($class) {
    require _PATH_ . 'classes/' . $class . '.class.php';
});

/**
 * Check recaptcha v3
 * @return boolean isOk
 */
function checkReCaptacha() {
    //https://gist.github.com/jonathanstark/dfb30bdfb522318fc819
    $post_data = http_build_query(
            array(
                'secret' => _RECATCHA_PRIVATE_KEY_,
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
    );
    $opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $post_data
        )
    );
    $context = stream_context_create($opts);
    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    $result = json_decode($response);
    return $result->{'success'};
}
