<?php
// ── CONFIGURATION ──────────────────────────────────────────
// Adaptez ces 4 valeurs à votre environnement local
define("DB_HOST", "localhost"); // adresse du serveur MySQL
define("DB_NAME", "blog_dwwm"); // nom de la base de données
define("DB_USER", "root"); // utilisateur MySQL
define("DB_PASS", ""); // mot de passe (vide sur WAMP/ et root sur MAMP par défaut)

// ── CONNEXION PDO ───────────────────────────────────────────
// PDO = PHP Data Objects : la façon moderne de parler à MySQL en PHP
try {
    // On construit le DSN (Data Source Name) : type:host=...;dbname=...
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    // On crée l'objet PDO : c'est lui qui représente la connexion
    $pdo = new PDO($dsn, DB_USER, DB_PASS);

    // On demande à PDO de lever une exception en cas d'erreur SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // On demande à PDO de retourner les résultats sous forme de tableaux associatifs
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, on affiche le message et on arrête
    die("Erreur de connexion : " . $e->getMessage());
}
?>

