<header class="container-fluid d-flex flex-row justify-content-between align-items-center my-5 bg-light py-3">

    <div class="col-4">
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <strong>Bonjour <?= htmlspecialchars($_SESSION['LOGGED_USER']['prenom']) ?></strong>
        <?php endif; ?>

        <p class="mb-0">Nous sommes le <?= date("d/m/Y") ?></p>
    </div>

    <div class="col-8 text-end">
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <a href="Read.php">Accueil</a>
            </li>
            <li class="list-inline-item">
                <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">
                <button class="btn btn-outline-primary">
                    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                        <a href="Logout.php">Se déconnecter</a>
                    <?php else : ?>
                        <a href="Login.php">Se connecter</a>
                    <?php endif; ?></button>
            </li>
        </ul>
    </div>

</header>