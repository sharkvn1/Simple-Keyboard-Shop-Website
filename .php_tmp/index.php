<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<title>Document</title>
</head>

<body>
    <?php
    require "data.php";

    use function database\GetData;

    $role = 0;
    if (isset($_COOKIE['is_admin'])) {
        $role = $_COOKIE['is_admin'];
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid Main-nav">
            <a class="navbar-brand" href="#">
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
                                <li><a class="dropdown-item" href="#" id="log-btn">Account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php if ($role == 1) : ?>
                                    <li><a class="dropdown-item" href="./admin/admin.php" id="log-btn">Admin Page</a></li>
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

    <div class="banner">
        <img src="./img/banner/slider_4.jpg" alt="banner" width="1596" height="909">
    </div>

    <div class="menu-slide">
        <?php
        $data = GetData('category');
        while ($row = mysqli_fetch_assoc($data)) :
            $path = $row['ImagePath'];
            $name = $row['CategoryName'];
            $id = $row['Id'];
        ?>

            <form action="./result.php" method="get">
                <?php echo "
                <button type='submit' name='btn' value='$id'>
                <img src='./$path' alt='menu-logo'/>
                <p>$name</p>
                </button>
                " ?>
            </form>

        <?php endwhile; ?>
        </form>
    </div>
    <div class="main-container">
        <?php
        $data = GetData('product');
        while ($row = mysqli_fetch_assoc($data)) :
        ?>
            <div class="card" style="width: 18rem;">
                <div class="product-img">
                    <img src="./<?= $row['ImagePath'] ?>" class="card-img-top" alt="logo" width="286" height="2">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $row['ProductName'] ?></h5>
                    <p class="card-text" style="color:red; font-weight:800;"><?= $row['Price'] ?></p>
                    <a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script src="https://kit.fontawesome.com/ec4ae96e25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>