<?php
require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');

requireRole(['admin']);

// Seuls les utilisateurs connectés peuvent consulter les logs
if (!isset($_SESSION['LOGGED_USER'])) {
    redirectToUrl('connexion');
}

$logFile = __DIR__ . '/../common/logs/actions.json';

$logs = [];
if (file_exists($logFile)) {
    $contenu = file_get_contents($logFile);
    $logs = json_decode($contenu, true) ?? [];
}

// Affiche les logs les plus récents en premier
$logs = array_reverse($logs);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once(__DIR__ . '/../common/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal des actions</title>
</head>

<body class="bg-dark text-light">
    <?php require_once(__DIR__ . '/../common/header.php'); ?>

    <div class="container my-5">
        <div class="d-flex justify-content-end">
            <a href="lire" class="btn btn-primary ">RETOUR</a>
        </div>
        <h1 class="mb-4">Journal des actions</h1>

        <?php if (empty($logs)) : ?>

            <p>Aucune action enregistrée pour le moment.</p>

        <?php else : ?>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Utilisateur</th>
                            <th>Action</th>
                            <th>Détails</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log) : ?>
                            <tr>
                                <td><?= htmlspecialchars($log['date'] ?? '') ?></td>
                                <td><?= htmlspecialchars($log['utilisateur'] ?? '') ?></td>
                                <td><?= htmlspecialchars($log['action'] ?? '') ?></td>
                                <td>
                                    <?php
                                    if (!empty($log['details'])) {
                                        $paires = [];
                                        foreach ($log['details'] as $cle => $valeur) {
                                            $paires[] = htmlspecialchars($cle) . ' : ' . htmlspecialchars($valeur);
                                        }
                                        echo implode(', ', $paires);
                                    }
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($log['ip'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>



    </div>

</body>

</html>