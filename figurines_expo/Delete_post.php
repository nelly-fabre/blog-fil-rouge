<?php

include(__DIR__ . '/connect.php');
include(__DIR__ . '/functions.php');


$postData = $_POST;


if (!isset($postData['id']) || !is_numeric($postData['id'])) {

    echo 'Il faut un identifiant valide pour supprimer un article.';
    return;
}


$deleteArticleStatement = $mysqlClient->prepare('DELETE FROM figurines WHERE id = :id');
$deleteValueStatement = $mysqlClient->prepare('DELETE FROM valeur Where figurine_id = :id');


$deleteArticleStatement->execute([
    'id' => (int)$postData['id'],
]);
$deleteValueStatement->execute([
    'id' => (int)$postData['id'],
]);



?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once(__DIR__ . '/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article supprimé</title>

</head>

<body>

    <p>Article supprimé avec succés</p> <br>


    <a class="btn btn-primary" role="button" href="Read.php">RETOUR</a>
</body>

</html>