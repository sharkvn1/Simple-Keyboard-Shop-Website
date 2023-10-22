<?php
$role = 0;
if (isset($_COOKIE['is_admin'])) {
    $role = $_COOKIE['is_admin'];
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid Main-nav">
        <a class="navbar-brand" href="index.php">
            <img src="./img/logo-removebg.png" alt="logo" width="121" height="44">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isset($_COOKIE['is_logged_in'])) : ?>
                            <li><a class="dropdown-item" href="./Account.php" id="log-btn">Account</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php if ($role == 1) : ?>
                                <li><a class="dropdown-item" href="./admin.php" id="log-btn">Admin Page</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php endif; ?>
                            <li>
                                <form class="dropdown-item" href="#" id="log-btn" method="get" action="./function.php">
                                    <button type="submit" name="logout" value="out">Logout</button>
                                </form>
                            </li>
                        <?php else :  ?>
                            <li><a class="dropdown-item" href="./register.php" id="log-btn">Register</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./login.php" id="log-btn">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <ul class="dropdown-menu">
                    </ul>
                </li>
            </ul>
            <form class="d-flex ms-4" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>