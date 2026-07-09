<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');


$postData = $_POST;


if (
    !isset($postData['id'])                          // L'ID doit être présent
    || !is_numeric($postData['id'])                  // L'ID doit être un nombre
    || empty($postData['nom'])
    || empty($postData['licence'])
    || empty($postData['description'])
    || empty($postData['prix_estime'])
    || empty($postData['etat'])

    || trim(strip_tags($postData['nom'])) === ''
    || trim(strip_tags($postData['licence'])) === ''
    || trim(strip_tags($postData['description'])) === ''
    || trim(strip_tags($postData['prix_estime'])) === ''
    || trim(strip_tags($postData['etat'])) === ''
) {

    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}


$id = (int)$postData['id'];

$nom = trim(strip_tags($postData['nom']));
$licence = trim(strip_tags($postData['licence']));
$description = trim(strip_tags($postData['description']));
if (!is_numeric($postData['prix_estime'])) {
    echo 'Le prix estimé doit être un nombre.';
    return;
}
$prix_estime = trim(strip_tags($postData['prix_estime']));
$etat = trim(strip_tags($postData['etat']));


$insertDescriptionStatement = $mysqlClient->prepare('UPDATE figurines SET nom = :nom, licence = :licence, description = :description WHERE id = :id');
$insertValueStatement = $mysqlClient->prepare('UPDATE valeur SET prix_estime = :prix_estime, etat = :etat WHERE figurine_id = :figurine_id');



$insertDescriptionStatement->execute([
    'nom' => $nom,
    'licence' => $licence,
    'description' => $description,
    'id' => $id,
]);

$insertValueStatement->execute([
    'prix_estime' => $prix_estime,
    'etat' => $etat,
    'figurine_id' => $id,


]);
logAction('modification_figurine', ['figurine_id' => $id]);
?>


<!-- ============================================
     6. AFFICHAGE DE LA PAGE DE CONFIRMATION
     ============================================ -->

<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/../common/head.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>article modifié</title>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Article modifié avec succès !</h1>


        <div class="card">
            <div class="card-body">
                <p class="mb-3 visually-hidden"><?php echo ($id); ?></p>en
                <h5 class="card-title"><?php echo $nom; ?></h5>

                <p class="card-text"><?php echo $licence; ?></p>
                <p class="card-text"><?php echo $description; ?></p>
                <p class="card-text"><?php echo $prix_estime; ?></p>
                <p class="card-text"><?php echo $etat; ?></p>
            </div>
        </div>
    </div>


    <a class="btn btn-primary" role="button" href="lire">RETOUR</a>
</body>

</html>