<?php
include(__DIR__ . '/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>

</head>

<body>
    <div class="d-flex flex-column">
        <div class="container">



            <h1>Ajouter un produit au catalogue</h1>
            <form action="Create_post.php" method="POST" enctype="multipart/form-data">


                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="licence" class="form-label">Licence</label>
                    <input type="text" class="form-control" id="licence" name="licence">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>

                <div class="mb-3">
                    <label for="prix_estime" class="form-label">Estimation de prix</label>
                    <input type="text" class="form-control" id="prix_estime" name="prix_estime">
                </div>
                <div class="mb-3">
                    <label for="etat" class="form-label">Etat du produit</label>
                    <input type="text" class="form-control" id="etat" name="etat">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Photo de la figurine</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">ENVOYER</button>

            </form>
            <a class="btn btn-primary" role="button" href="Read.php">RETOUR</a>
        </div>
    </div>
</body>

</html>