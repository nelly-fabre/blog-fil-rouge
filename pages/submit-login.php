<?php

require(__DIR__ . '/../common/connect.php');
include(__DIR__ . '/../common/functions.php');

$postData = $_POST;

if (isset($postData['login']) && isset($postData['mdp'])) {

    foreach ($admins as $user) {
        if (
            $user['login'] === $postData['login'] &&
            $user['password_hash'] === $postData['mdp']
        ) {
            $_SESSION['LOGGED_USER'] = [
                'login' => $user['login'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
            ];
        }
    }

    if (!isset($_SESSION['LOGGED_USER'])) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $postData['login'],
            strip_tags($postData['mdp'])
        );
        redirectToUrl('connexion');
    }

    // ✅ Authentification réussie : on redirige vers la page principale
    redirectToUrl('lire');
}
