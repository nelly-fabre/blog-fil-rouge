<?php
require(__DIR__ . '/../common/connect.php');
include(__DIR__ . '/../common/functions.php');

if (!isset($_SESSION['LOGGED_USER'])) {
    redirectToUrl('connexion'); // au lieu de redirectToUrl('Read.php')
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/../common/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figurines</title>

</head>

<body class="bg-dark">
    <?php require_once(__DIR__ . '/../common/header.php'); ?>
    <div class="col-4 text-light mx-md-5">
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <strong>Bonjour <?= htmlspecialchars($_SESSION['LOGGED_USER']['login']) ?></strong>
        <?php endif; ?>

        <p class="mb-0">Nous sommes le <?= date("d/m/Y") ?></p>
    </div>
    <h1 class="mb-5 text-center text-light">Collection de figurines</h1>


    <div class="d-flex ms-5">
        <a class="btn btn-outline-success" href="ajouter">Ajouter une figurine</a>
    </div>
    <div class="container">
        <div class="row">

            <?php

            foreach ($figurines as $figurine) {

            ?>

                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">

                            <h2 class='card-title' style="color: #ff5e00"><?= htmlspecialchars(($figurine['nom'])) ?></h2>

                            <?php
                            $imagePath = "img/" . $figurine['id'] . ".webp";
                            if (file_exists($imagePath)) {
                                $image = "$imagePath";
                            } else {
                                $image = "https://picsum.photos/100/250";
                            }

                            echo "<img src=\"$image\" class=\"card-img-top object-fit-cover\" style=\"height: 200px;\" alt=\"" . htmlspecialchars($figurine['nom']) . "\">";
                            ?>


                            <p><strong>Estimation <?= htmlspecialchars($figurine['prix_estime'] ?? ''); ?>€</strong></p>
                            (Etat : <?= htmlspecialchars($figurine['etat'] ?? ''); ?>)
                            <br>
                            <br>
                            <hr>

                            <?= htmlspecialchars($figurine['description']); ?>

                            <p><strong>Date d'ajout de l'article : </strong><?= htmlspecialchars($figurine['date_ajout']); ?>

                            </p><br><br><br><br>


                            <a class="btn btn-outline-danger" href="supprimer?id=<?= htmlspecialchars($figurine['id']) ?>">Supprimer</a>
                            <a class="btn btn-outline-warning" href="modifier?id=<?= htmlspecialchars($figurine['id']) ?>">Modifier</a>
                            <a class="btn btn-outline-primary" href="figurine/<?= $figurine['id'] ?>-<?= slugify($figurine['nom']) ?>.html">En savoir +</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>



</body>

</html>