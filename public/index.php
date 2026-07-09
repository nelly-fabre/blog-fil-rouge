<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');

// Récupère l'URL demandée, sans slash au début/fin
$url = trim($_GET['url'] ?? '', '/');
$url = $url === '' ? 'accueil' : $url;

// ============================================================
// LA TABLE DE ROUTAGE : associe une URL à un fichier PHP précis
// ============================================================
$routes = [
    'accueil' => __DIR__ . '/../pages/accueil.php',
    'lire' => __DIR__ . '/../pages/Read.php',
    'connexion' => __DIR__ . '/../pages/login.php',
    'connexion-post' => __DIR__ . '/../pages/submit-login.php',
    'deconnexion' => __DIR__ . '/../pages/logout.php',
    'ajouter' => __DIR__ . '/../pages/Create.php',
    'ajouter-post' => __DIR__ . '/../pages/Create_post.php',
    'modifier' => __DIR__ . '/../pages/Update.php',
    'modifier-post' => __DIR__ . '/../pages/Update_post.php',
    'supprimer' => __DIR__ . '/../pages/Delete.php',
    'supprimer-post' => __DIR__ . '/../pages/Delete_post.php',
];

// Cas particulier : les fiches figurines (figurine/23-nom-du-slug)
if (preg_match('#^figurine/([0-9]+)#', $url, $matches)) {
    $_GET['id'] = (int) $matches[1];
    require(__DIR__ . '/../pages/article.php');
    exit;
}

// ============================================================
// EXECUTION DE LA ROUTE DEMANDEE
// ============================================================
if (array_key_exists($url, $routes)) {
    require($routes[$url]);
} else {
    http_response_code(404);
    echo "Page non trouvee.";
}

exit;
