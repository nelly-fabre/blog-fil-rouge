<?php

require_once(__DIR__ . '/../common/connect.php');

$postData = $_POST;

if (
    empty($postData['nom'])
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

    echo 'Merci de remplir tout les champs du formulaire';
    return;
}



$nom = trim(strip_tags($postData['nom']));
$licence = trim(strip_tags($postData['licence']));
$description = trim(strip_tags($postData['description']));
if (!is_numeric($postData['prix_estime'])) {
    echo 'Le prix estimé doit être un nombre.';
    return;
}
$prix_estime = trim(strip_tags($postData['prix_estime']));
$etat = trim(strip_tags($postData['etat']));

$insertvalue = $mysqlClient->prepare('INSERT INTO valeur(figurine_id, prix_estime, etat)
VALUES (:figurine_id, :prix_estime, :etat)');

$insertcontenu = $mysqlClient->prepare('INSERT INTO figurines(nom, description,licence,date_ajout,vendeur_id)
VALUES (:nom,:description,:licence,:date_ajout,:vendeur_id)');


$insertcontenu->execute([

    'nom' => $nom,
    'licence' => $licence,
    'description' => $description,

    'date_ajout' => date('Y-m-d'),
    'vendeur_id' => 0,
]);

$figurine_id = $mysqlClient->lastInsertId();

$insertvalue->execute([
    'figurine_id' => $figurine_id,
    'prix_estime' => $prix_estime,
    'etat' => $etat,
]);


if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {


    $typeMime = mime_content_type($_FILES['image']['tmp_name']);


    if ($typeMime === "image/webp") {


        $dossier = "/public/img/";
        $nomFichier = $figurine_id . ".webp";


        move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $nomFichier);
    } else {
        echo "Erreur : seul le format WEBP est accepté.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/../common/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'article</title>
</head>

<body>

    <div class="container">

        <h1>Article ajouté avec succès ! </h1>


        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $nom; ?></h5>
                <p class="card-text"><?php echo $licence; ?></p>
                <p class="card-text"> <?php echo $description; ?></p>
                <p class="card-text"> <?php echo $prix_estime; ?></p>
                <p class="card-text"> <?php echo $etat; ?></p>
            </div>
        </div>

        <a class="btn btn-primary" role="button" href="lire">RETOUR</a>
    </div>

</body>

</html>