<?php

/**
 * Enregistre une action dans le fichier de logs JSON
 */

function logAction(string $action, array $details = []): void
{
    $logFile = __DIR__ . '/logs/actions.json';

    // Récupère l'utilisateur connecté, si disponible
    $user = $_SESSION['LOGGED_USER']['login'] ?? 'invité';

    // Construit l'entrée de log
    $entry = [
        'date' => date('Y-m-d H:i:s'),
        'utilisateur' => $user,
        'action' => $action,
        'details' => $details,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'inconnue',
    ];

    // Lit les logs existants (ou tableau vide si le fichier n'existe pas encore)
    $logs = [];
    if (file_exists($logFile)) {
        $contenuActuel = file_get_contents($logFile);
        $logs = json_decode($contenuActuel, true) ?? [];
    }

    // Ajoute la nouvelle entrée
    $logs[] = $entry;

    // Réécrit le fichier avec un JSON lisible (indenté)
    file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
