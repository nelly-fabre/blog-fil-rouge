<?php

require(__DIR__ . '/connect.php');
include(__DIR__ . '/functions.php');




$postData = $_POST;


if (isset($postData['login']) && isset($postData['mdp'])) {



    foreach ($admins as $user) {

        if (
            $user['login'] === $postData['login'] &&
            $user['password_hash'] === $postData['mdp']
        ) {
            /*
                 * ✅ AUTHENTIFICATION RÉUSSIE
                 *
                 * On stocke les informations de l'utilisateur en session
                 * Attention : On ne stocke JAMAIS le mot de passe en session !
                 */
            $_SESSION['LOGGED_USER'] = [
                'login' => $user['login'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
            ];
        }
    }



    if (!isset($_SESSION['LOGGED_USER'])) {
        /*
             * ❌ ÉCHEC DE L'AUTHENTIFICATION
             *
             * Aucun utilisateur ne correspond aux identifiants fournis
             * On crée un message d'erreur
             *
             * sprintf() permet de formater une chaîne avec des variables
             * strip_tags() retire les balises HTML pour éviter les injections XSS
             */
        $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $postData['login'],
            strip_tags($postData['mdp'])
        );
        redirectToUrl('login.php');
    }
}


redirectToUrl('logout.php');
