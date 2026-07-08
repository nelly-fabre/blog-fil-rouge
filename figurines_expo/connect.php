<?php

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
