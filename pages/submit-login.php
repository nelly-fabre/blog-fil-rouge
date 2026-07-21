<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');

$postData = $_POST;

if (isset($postData['login']) && isset($postData['mdp'])) {

    foreach ($admins as $user) {
        if (
            $user['login'] === $postData['login']
            && password_verify($postData['mdp'], $user['password_hash'])
        ) {
            $_SESSION['LOGGED_USER'] = [
                'login' => $user['login'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'droits' => $user['droits'],
            ];
        }
    }

    if (!isset($_SESSION['LOGGED_USER'])) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $postData['login'],
            strip_tags($postData['mdp'])
        );
        logAction('connexion_echouee', ['login_tente' => $postData['login']]);
        redirectToUrl('connexion');
    }

    // ✅ Authentification réussie : on redirige vers la page principale
    logAction('connexion_reussie');
    redirectToUrl('lire');
}
