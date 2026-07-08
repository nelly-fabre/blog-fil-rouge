<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figurines</title>

</head>

<body class="bg-dark">
    <h1 class="my-5 text-center text-light">Collection de figurines</h1>


    <div class="d-flex ms-5">
        <a class="btn btn-outline-success" href="Create.php">Ajouter une figurine</a>
    </div>
    <div class="container">
        <div class="row">



            <?php
            include(__DIR__ . '/connect.php');

            $sqlQuery = '
SELECT f.id, f.nom, f.licence,f.description, f.date_ajout, v.prix_estime, v.etat
FROM figurines f
LEFT JOIN valeur v ON f.id = v.figurine_id
ORDER BY `f`.`date_ajout`
DESC;';

            $lastFigurines = $mysqlClient->prepare($sqlQuery);
            $lastFigurines->execute();


            $figurines = $lastFigurines->fetchAll();



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


                            <a class="btn btn-outline-danger" href="/Delete.php?id=<?= htmlspecialchars($figurine['id']) ?>">Supprimer</a>
                            <a class="btn btn-outline-warning" href="/Update.php?id=<?= htmlspecialchars($figurine['id']) ?>">Modifier</a>
                            <a class="btn btn-outline-primary" href="/article.php?id=<?= htmlspecialchars($figurine['id']) ?>">En savoir +</a>
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