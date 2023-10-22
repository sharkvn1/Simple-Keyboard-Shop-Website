<nav class="nav-main navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid Main-nav">
        <a class="navbar-brand" href="#">
            <img src="./img/logo-removebg.png" alt="logo" width="121" height="44">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        User
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="log-btn">Account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form class="dropdown-item" href="#" id="log-btn" method="get" action="../function.php">
                                <button type="submit" name="logout" value="out">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="nav-item nav-text">
                <a class="nav-link" aria-disabled="true">Xshop Admin Page</a>
            </div>
        </div>
    </div>
</nav>