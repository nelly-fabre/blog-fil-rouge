<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');

requireRole(['editeur', 'admin']);

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
logAction('creation_figurine', ['figurine_id' => $figurine_id, 'nom' => $nom]);

$insertvalue->execute([
    'figurine_id' => $figurine_id,
    'prix_estime' => $prix_estime,
    'etat' => $etat,
]);


if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {


    $typeMime = mime_content_type($_FILES['image']['tmp_name']);


    if ($typeMime === "image/webp") {


        $dossier = __DIR__ . "/../public/assets/img/";
        $nomFichier = $figurine_id . ".webp";


        move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $nomFichier);
    } else {
        echo "Erreur : seul le format WEBP est accepté.";
    }
}


?>


<?php require(__DIR__ . '/../common/header.php'); ?>

<body>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Article ajouté avec succès !
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