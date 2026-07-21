<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');




if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $figurineId = (int) $_GET['id'];

    $sqlQuery = '
        SELECT f.id, f.nom, f.licence, f.description, f.date_ajout, v.prix_estime, v.etat
        FROM figurines f
        LEFT JOIN valeur v ON f.id = v.figurine_id
        WHERE f.id = :id';

    $statement = $mysqlClient->prepare($sqlQuery);
    $statement->bindParam(':id', $figurineId, PDO::PARAM_INT);
    $statement->execute();

    $figurine = $statement->fetch();

?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <?php require_once(__DIR__ . '/../common/head.php'); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Figurines | <?= $figurine ? htmlspecialchars($figurine['nom']) : 'Article introuvable'; ?></title>

    </head>

    <body class="bg-dark">
        <?php require_once(__DIR__ . '/../common/header.php'); ?>

        <div class="container text-center d-flex flex-wrap justify-content-center">

            <?php
            // ============================================================
            // AFFICHAGE DE LA FIGURINE
            // ============================================================

            if ($figurine) {

                echo "<div class='card col-9 m-2 p-3'>";

                // ============================================================
                // GESTION DE L'IMAGE
                // ============================================================


                $imagePath = __DIR__ . '/../public/assets/img/' . $figurine['id'] . '.webp';
                if (file_exists($imagePath)) {
                    $image = BASE_URL .  '/assets/img/' . $figurine['id'] . '.webp';
                } else {
                    $image = "https://picsum.photos/100/200";
                }

                echo "<img src=\"$image\" class=\"card-img-top object-fit-contain\" style=\"height: 400px;\" alt=\"" . htmlspecialchars($figurine['nom']) . "\">";

                echo "<h1>" . htmlspecialchars($figurine['nom']) . "</h1>";

                echo "<p>Ajoutée le : " . htmlspecialchars($figurine['date_ajout']) . "</p>";

                echo $figurine['licence'] ? "<strong style=\"color:#FF0000\">Licence : " . htmlspecialchars($figurine['licence']) . "</strong>" : "";

                echo $figurine['etat'] ? "<p>État : " . htmlspecialchars($figurine['etat']) . "</p>" : "";

                echo $figurine['prix_estime'] ? "<p>Estimation : " . htmlspecialchars($figurine['prix_estime']) . " €</p>" : "";

                echo "<p>" . htmlspecialchars($figurine['description']) . "</p>";

                echo "<button class='btn btn-warning col-2 d-block mx-auto' id=\"webShare\" 
                        data-title=\"" . htmlspecialchars($figurine['nom']) . "\" 
                        data-text=\"Découvrez " . htmlspecialchars($figurine['nom']) . " sur notre site\" 
                        data-url=\"" . htmlspecialchars("http://localhost/figurine/{$figurine['id']}-" . slugify($figurine['nom'])) . "\">Partagez</button>";

                echo "</div>";
            } else {
                echo "<p>Figurine non trouvée.</p>";
            }
            ?>

            <!-- Zone des boutons -->
            <div class="col-12">


                <a class="btn btn-primary" role="button" href="<?= BASE_URL ?>//lire">RETOUR</a>

                <div id="shareAlert" class="alert"></div>
            </div>

        </div>
        <?php require_once(__DIR__ . '/../common/footer.php'); ?>
        <script src="<?= BASE_URL ?>//assets/js/share.js"></script>
    </body>

    </html>

<?php
} else {
    echo "<div class='card m-5 p-5'><p>Identifiant de figurine manquant ou invalide.</p></div>";
}
?>