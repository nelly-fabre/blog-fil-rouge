<?php

require_once(__DIR__ . '/../common/connect.php');
require_once(__DIR__ . '/../common/functions.php');
require_once(__DIR__ . '/../common/header.php');
requireRole(['admin']);


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {

    echo ('Il faut un identifiant pour supprimer un article. Exemple : http://nelly-fabre.fr/Delete.php?id=9');
    return;
}


?>



<body class="d-flex flex-column min-vh-100">
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Voulez-vous vraiment supprimer cet article ?
                    </h5>
                </div>

                <form action="supprimer-post" method="POST">


                    <div class="mb-3 visually-hidden">

                        <label for="id" class="form-label">Voulez-vous supprimer cet article <?php echo $getData['id']; ?> ?</label>

                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $getData['id']; ?>">
                    </div>

                    <div class="d-flex justify-content-center my-3">

                        <button type="submit" class="btn btn-danger">Oui !</button>


                        <a class="btn btn-primary" role="button" href="lire">Annuler</a>

                    </div>
                </form>

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