<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');

requireRole(['admin']);


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

<?php require(__DIR__ . '/../common/header.php'); ?>

<body class="d-flex flex-column min-vh-100">
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Article modifié avec succès !
                    </h5>
                </div>

                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <h5><?= $nom ?></h5>

                            <p><?= $licence ?></p>

                            <p><?= $description ?></p>

                            <p><?= $prix_estime ?> €</p>

                            <p><?= $etat ?></p>

                        </div>
                    </div>

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