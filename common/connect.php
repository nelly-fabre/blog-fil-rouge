<?php
session_start();
require_once(__DIR__ . '/../common/logger.php');


// Détection automatique de l'URL de base
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$baseFolder = dirname($_SERVER['SCRIPT_NAME']);
define('BASE_URL', $protocol . $host . $baseFolder);

// Si vous préférez le définir manuellement par exemple :
// define('BASE_URL', '/git/php/php103+50/public');


try {

    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=expo_figurines;charset=utf8',
        'root',
        ''
    );

    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $error_message) {

    die('Erreur de connexion à la base de données : ' . $error_message->getMessage());
}
