<?php

$postData = $_POST;

// ============================================================
// VALIDATION DES CHAMPS
// ============================================================

if (
    empty($postData['login'])
    || empty($postData['mdp'])
    || empty($postData['mdp_confirmation'])
) {
    $_SESSION['INSCRIPTION_ERROR_MESSAGE'] = 'Merci de remplir tous les champs.';
    redirectToUrl('inscription');
}

$login = trim(strip_tags($postData['login']));
$mdp = $postData['mdp'];
$mdpConfirmation = $postData['mdp_confirmation'];

if ($mdp !== $mdpConfirmation) {
    $_SESSION['INSCRIPTION_ERROR_MESSAGE'] = 'Les mots de passe ne correspondent pas.';
    redirectToUrl('inscription');
}

if (strlen($mdp) < 8) {
    $_SESSION['INSCRIPTION_ERROR_MESSAGE'] = 'Le mot de passe doit contenir au moins 8 caractères.';
    redirectToUrl('inscription');
}

// ============================================================
// VERIFICATION QUE L'IDENTIFIANT N'EST PAS DEJA PRIS
// ============================================================

$checkStatement = $mysqlClient->prepare('SELECT id FROM admins WHERE login = :login');
$checkStatement->execute(['login' => $login]);

if ($checkStatement->fetch()) {
    $_SESSION['INSCRIPTION_ERROR_MESSAGE'] = 'Cet identifiant est déjà utilisé.';
    redirectToUrl('inscription');
}

// ============================================================
// CREATION DU COMPTE, AVEC LE ROLE "lecteur" PAR DEFAUT
// ============================================================

$passwordHash = password_hash($mdp, PASSWORD_DEFAULT);

$insertStatement = $mysqlClient->prepare(
    'INSERT INTO admins (login, password_hash, droits)
     VALUES (:login, :password_hash, :droits)'
);

$insertStatement->execute([
    'login' => $login,
    'password_hash' => $passwordHash,
    'droits' => 'lecteur',

]);

logAction('inscription', ['login' => $login]);

redirectToUrl('connexion');
