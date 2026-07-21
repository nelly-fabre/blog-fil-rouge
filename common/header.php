<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figurines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>


<header class="container-fluid bg-light py-3">



    <ul class="list-inline d-flex justify-content-center align-items-center mb-0">
        <li class="list-inline-item">
            <a href="<?= BASE_URL ?>/lire" class="btn btn-outline-secondary">Accueil</a>
        </li>

        <li class="list-inline-item">
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <?php if (($_SESSION['LOGGED_USER']['droits'] ?? null) === 'admin') : ?>
        <li class="list-inline-item">
            <a href="<?= BASE_URL ?>/logs" class="btn btn-outline-secondary">Logs</a>
        </li>
    <?php endif; ?>
    <a href="<?= BASE_URL ?>/deconnexion" class="btn btn-outline-primary">Se déconnecter</a>
<?php else : ?>
    <a href="<?= BASE_URL ?>/connexion" class="btn btn-outline-primary">Se connecter</a>
    <a href="<?= BASE_URL ?>/inscription" class="btn btn-primary"> S'inscrire</a>
<?php endif; ?>
</li>
    </ul>



</header>