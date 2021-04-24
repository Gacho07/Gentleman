<nav class="navbar navbar-expand-sm">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navToggler" aria-controls="navToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 navigation-links">
            <?php
            $menu_all_users = getMenuForAllUsers();
            foreach ($menu_all_users as $menu) :
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=<?= $menu->link ?>"><?= $menu->text ?></a>
                </li>
            <?php endforeach; ?>
            <?php if (!isset($_SESSION["user"])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login_register">Login</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="models/logout.php">Logout</a>
                </li>
            <?php endif; ?>

            <?php
            if (isset($_SESSION["user"])) :
                if ($_SESSION["user"]->role_name == "user") :
                    $menu_authorized_users = getMenuForAuthorizedUsers();
                    foreach ($menu_authorized_users as $m_a_u) :
            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=<?= $m_a_u->link ?>"><?= $m_a_u->text ?></a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php
            if (isset($_SESSION["user"])) :
                if ($_SESSION["user"]->role_name == "admin") :
                    $menu_admin = getMenuForAdmin();
                    foreach ($menu_admin as $m_a) :
            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=<?= $m_a->link ?>"><?= $m_a->text ?></a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="logo d-none d-sm-block">
        <a href="index.php?page=home" class="navbar-brand">
            <img src="assets/img/logo.png" alt="logo" class="logo" />
        </a>
    </div>
</nav>