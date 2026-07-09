<header class="container-fluid bg-light py-3">



    <ul class="list-inline d-flex justify-content-center align-items-center mb-0">
        <li class="list-inline-item">
            <a href="/pages/Read.php">Accueil</a>
        </li>
        <li class="list-inline-item">
            <a href="#">Contact</a>
        </li>
        <li class="list-inline-item">
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <a href="/pages/logout.php" class="btn btn-outline-primary">Se déconnecter</a>
            <?php else : ?>
                <a href="/pages/login.php" class="btn btn-outline-primary">Se connecter</a>
            <?php endif; ?>
        </li>
    </ul>



</header>