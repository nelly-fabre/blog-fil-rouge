<?php
include(__DIR__ . '/connect.php');
include(__DIR__ . '/functions.php');
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/head.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>

        <div class="d-flex flex-column min-vh-100 bg-light">
            <div class="container d-flex justify-content-center align-items-center flex-grow-1">
                <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
                    <div class="card-body p-4">

                        <h1 class="card-title text-center mb-4 h3">Connexion</h1>

                        <form action="submit-login.php" method="POST">

                            <?php if (!empty($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php
                                    echo htmlspecialchars($_SESSION['LOGIN_ERROR_MESSAGE']);
                                    unset($_SESSION['LOGIN_ERROR_MESSAGE']);
                                    ?>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="mdp" name="mdp" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    <?php elseif (!isset($_SESSION['MODAL_SHOWN'])) : ?>

        <?php $_SESSION['MODAL_SHOWN'] = true; ?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Bienvenue <?= htmlspecialchars($_SESSION['LOGGED_USER']['nom']) ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        Bienvenue sur le site des collectionneurs ! <br>
                        Vous avez à présent accès aux différentes figurines et à leurs infos.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>

                </div>
            </div>
        </div>



        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
        </script>

    <?php endif; ?>