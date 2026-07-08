<header class="container-fluid d-flex flex-row justify-content-between align-items-center my-5 bg-light py-3">



    <div class="col-8 text-end">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <a href="<?= BASE_URL ?>/Read.php">Accueil</a>
            </li>
            <li class="list-inline-item">
                <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">
                <button class="btn btn-outline-primary">
                    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                        <a href="<?= BASE_URL ?>/logout.php">Se déconnecter</a>
                    <?php else : ?>
                        <a href="<?= BASE_URL ?>/login.php">Se connecter</a>
                    <?php endif; ?></button>
            </li>
        </ul>
    </div>

</header>