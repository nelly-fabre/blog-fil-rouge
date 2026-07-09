<?php
require_once(__DIR__ . '/connect.php');

// Vide toutes les données stockées dans la session
$_SESSION = [];

// Supprime le cookie de session côté navigateur
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Détruit la session côté serveur
session_destroy();

// Redirige vers la page d'accueil
header('Location: index.php');
exit;
