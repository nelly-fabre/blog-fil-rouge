<header class="container-fluid bg-light py-3">



    <ul class="list-inline d-flex justify-content-center align-items-center mb-0">
        <li class="list-inline-item">
            <a href="lire" class="btn btn-outline-secondary">Accueil</a>
        </li>

        <li class="list-inline-item">
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <?php if (($_SESSION['LOGGED_USER']['droits'] ?? null) === 'admin') : ?>
        <li class="list-inline-item">
            <a href="logs" class="btn btn-outline-secondary">Logs</a>
        </li>
            <?php endif; ?>
        <a href="deconnexion" class="btn btn-outline-primary">Se déconnecter</a>
    <?php else : ?>
        <a href="connexion" class="btn btn-outline-primary">Se connecter</a>
    <?php endif; ?>
    </li>
    </ul>



</header>