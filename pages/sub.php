<?php
require_once(__DIR__ . '/../common/functions.php');
?>

<?php require(__DIR__ . '/../common/header.php'); ?>

<body>

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body p-4">

                <h1 class="card-title text-center mb-4 h3">Créer un compte</h1>

                <?php if (!empty($_SESSION['INSCRIPTION_ERROR_MESSAGE'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo htmlspecialchars($_SESSION['INSCRIPTION_ERROR_MESSAGE']);
                        unset($_SESSION['INSCRIPTION_ERROR_MESSAGE']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/inscription-post" method="POST">



                    <div class="mb-3">
                        <label for="login" class="form-label">Identifiant</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>

                    <div class="mb-3">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>

                    <div class="mb-3">
                        <label for="mdp_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="mdp_confirmation" name="mdp_confirmation" required>
                    </div>
                    <p class="mb-3"> * 8 caractères minimum</p>
                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>

                </form>

            </div>
        </div>
    </div>