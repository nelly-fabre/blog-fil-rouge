<?php

include('connect.php');


$getData = $_GET;


if (!isset($getData['id']) || !is_numeric($getData['id'])) {

    echo ('Il faut un identifiant de figurine pour la modifier.');
    return;
}


$retrieveFigurineStatement = $mysqlClient->prepare('SELECT nom, licence, description FROM  figurines WHERE id = :id');
$retrieveValueStatement = $mysqlClient->prepare('SELECT prix_estime, etat FROM  valeur WHERE figurine_id = :id');

$retrieveFigurineStatement->execute([
    'id' => (int)$getData['id'],
]);
$retrieveValueStatement->execute([
    'id' => (int)$getData['id'],
]);

$figurine = $retrieveFigurineStatement->fetch(PDO::FETCH_ASSOC);
$value = $retrieveValueStatement->fetch(PDO::FETCH_ASSOC);


if (!$figurine) {
    echo ('Annonce introuvable. Vérifiez l\'ID fourni.');
    return;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition d'article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Mettre à jour <?php echo ($figurine['nom']); ?></h1>

        <form action="Update_post.php" method="POST">


            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de l'annonce</label>

                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo ($getData['id']); ?>">
            </div>


            <div class="mb-3">
                <label for="nom" class="form-label">Nom </label>
                <input type="text" class="form-control" id="nom" name="nom" aria-describedby="titre-help" value="<?php echo ($figurine['nom']); ?>">
                <div id="titre-help" class="form-text">Ecrire le nom de la figurine</div>
            </div>

            <div class="mb-3">
                <label for="licence" class="form-label">Licence</label>
                <textarea class="form-control" placeholder="" id="licence" name="licence"><?php echo $figurine['licence']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" placeholder="" id="description" name="description"><?php echo $figurine['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="prix_estime" class="form-label">Estimation du prix</label>
                <textarea class="form-control" placeholder="" id="prix_estime" name="prix_estime"><?php echo $value['prix_estime']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="etat" class="form-label">Etat</label>
                <textarea class="form-control" placeholder="" id="etat" name="etat"><?php echo $value['etat']; ?></textarea>
            </div>



            <!-- BOUTONS D'ACTION -->
            <button type="submit" class="btn btn-primary">Envoyer</button>
            <a class="btn btn-primary" role="button" href="Read.php">RETOUR</a>
        </form>
        <br />
    </div>


</body>

</html>