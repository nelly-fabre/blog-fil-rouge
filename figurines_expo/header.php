<div class="container d-flex flex-row justify-content-between align-items-center my-5">


    <div class="col-4">
        <!-- Logo cliquable qui renvoie à l'accueil -->
        <a href="Read.php">
            <img src="/figurines_expo/img/nezuko.webp" class="w-50" alt=""></a><br> "


        <?php if (isset($_SESSION['LOGGED_USER'])) : echo $_SESSION['LOGGED_USER']['prenom'];
        endif; ?>


        Nous somme le <?php echo date("d/m/Y") ?></p>
    </div>


    <div class="col-8 text-end d-flex gap-5">
        <div>

        </div>
        <div>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="Read.php">Accueil</a>
                </li>

                <li class="list-inline-item">
                    <a href="#">menu 2</a>
                </li>
                <li class="list-inline-item">
                    <a href="#">menu 3</a>
                </li>
                <li class="list-inline-item">
                    <a href="#">contact</a>
                </li>
            </ul>
        </div>

    </div>
</div>