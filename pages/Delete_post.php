<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');

requireRole(['admin']);


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

logAction('suppression_figurine', ['figurine_id' => (int) $postData['id']]);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once(__DIR__ . '/../common/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article supprimé</title>

</head>

<body>

   <div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Article supprimé avec succès !
                </h5>
            </div>

            
            <div class="modal-footer">
                <a href="lire" class="btn btn-primary">
                    Retour
                </a>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = new bootstrap.Modal(
        document.getElementById("successModal")
    );

    modal.show();
});
</script>
</body>

</html>