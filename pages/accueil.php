<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figurines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php require(__DIR__ . '/../common/header.php'); ?>

    <div class="container">

        <div class="text-center mb-4">
            <h1>Découvrez nos figurines</h1>
            <p class="text-muted">Un aperçu de notre catalogue de collection</p>
        </div>

        <div class="row">

            <?php
            $sqlQuery = '
                SELECT f.id, f.nom, f.licence, f.description, f.date_ajout, v.prix_estime, v.etat
                FROM figurines f
                LEFT JOIN valeur v ON f.id = v.figurine_id
                ORDER BY f.date_ajout DESC
                LIMIT 3';

            $lastFigurines = $mysqlClient->prepare($sqlQuery);
            $lastFigurines->execute();
            $figurines = $lastFigurines->fetchAll();

            foreach ($figurines as $figurine) :

                $imagePath = __DIR__ . '/../public/assets/img/' . $figurine['id'] . '.webp';
                $image = file_exists($imagePath) ? '/assets/img/' . $figurine['id'] . '.webp' : "https://picsum.photos/300/200";
            ?>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">

                        <img src="<?= htmlspecialchars($image) ?>" class="card-img-top object-fit-cover" style="height: 200px;" alt="<?= htmlspecialchars($figurine['nom']) ?>">

                        <div class="card-body">
                            <h2 class="card-title h5" style="color: #ff5e00"><?= htmlspecialchars($figurine['nom']) ?></h2>

                            <p><strong>Estimation : <?= htmlspecialchars($figurine['prix_estime'] ?? '') ?> €</strong></p>
                            <p>État : <?= htmlspecialchars($figurine['etat'] ?? '') ?></p>

                            <p><?= htmlspecialchars($figurine['description']) ?></p>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>

            <div class="card text-center p-5 my-5 bg-light">
                <h3>Envie d'en voir plus ?</h3>
                <p class="mb-4">Connectez-vous pour accéder à l'intégralité de notre catalogue de figurines.</p>
                <div>
                    <a href="connexion" class="btn btn-primary">Se connecter</a>
                </div>
            </div>

        <?php else : ?>

            <div class="text-center my-5">
                <a href="lire" class="btn btn-primary">Voir tout le catalogue</a>
            </div>

        <?php endif; ?>

    </div>

</body>

</html>