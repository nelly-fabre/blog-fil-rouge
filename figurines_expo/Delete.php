<?php

include(__DIR__ . '/connect.php');


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {

    echo ('Il faut un identifiant pour supprimer un article. Exemple : http://nelly-fabre.fr/Delete.php?id=9');
    return;
}


?>


<!DOCTYPE html>
<html>

<head>
    <?php require_once(__DIR__ . '/head.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un article</title>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">


        <h1>Supprimer l'article</h1>


        <form action="/Delete_post.php" method="POST">


            <div class="mb-3 visually-hidden">

                <label for="id" class="form-label">Voulez-vous supprimer cet article <?php echo $getData['id']; ?> ?</label>

                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $getData['id']; ?>">
            </div>


            <button type="submit" class="btn btn-danger">Oui !</button>


            <a class="btn btn-primary" role="button" href="Read.php">Annuler</a>
        </form>
        <br />
    </div>

</body>

</html>