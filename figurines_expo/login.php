<?php


if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <div class="card col-12 col-md-4 p-3">

        <form action="submit-login.php" method="POST">

            <?php if (!empty($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php

                    echo htmlspecialchars($_SESSION['LOGIN_ERROR_MESSAGE']);

                    unset($_SESSION['LOGIN_ERROR_MESSAGE']);
                    ?>
                </div>
            <?php endif; ?>

            <!--  Email -->
            <div class="mb-3">
                <h2>Vous voulez lire plus ? Abonnez-vous :</h2>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required
                    aria-describedby="email-help" placeholder="you@exemple.com">
                <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>

                <input type="password" class="form-control" id="mdp" name="mdp" required>
            </div>


            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <?php else :

    if (!isset($_SESSION['MODAL_SHOWN'])) :

        $_SESSION['MODAL_SHOWN'] = true;
    ?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Bienvenue <?php echo $_SESSION['LOGGED_USER']['nom']; ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        Bienvenue sur le site des collectionneurs ! <br>
                        Vous avez à présent accès aux différentes figurines et a leurs infos.
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Import de Bootstrap JavaScript (nécessaire pour les modales) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

        <!--
            Script JavaScript pour afficher automatiquement la modale
            DOMContentLoaded : attend que la page soit complètement chargée
        -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Création d'une instance de modale Bootstrap
                const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                // Affichage de la modale
                myModal.show();
            });
        </script>
<?php
    endif;
endif;
?>