<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    $page = $_GET['page'] ?? "danhmuc";
    require_once "./components/adminNav.php";
    ?>
    <div class="main">
        <div class="menu">
            <?php
            require_once "./components/AdminMenu/menu.php";
            switch ($page):
                default:
                    require_once "./components/AdminMenu/category.php";
                    break;
                case 'sanpham':
                    require_once "./components/AdminMenu/product.php";
                    break;
                case 'nhasanxuat':
                    require_once "./components/AdminMenu/manufacturer.php";
                    break;
                case 'nguoidung':
                    break;
                case 'binhluan':
                    break;
            endswitch;
            ?>
        </div>
        <?php
        switch ($page) {
            default:
                require_once "./components/AdminMain/categoryAdmin.php";
                break;
            case 'sanpham':
                require_once "./components/AdminMain/productAdmin.php";
                break;
            case 'nhasanxuat':
                require_once "./components/AdminMain/manufacturerAdmin.php";
                break;
            case 'nguoidung':
                require_once "./components/AdminMain/userAdmin.php";
                break;
            case 'binhluan':
                require_once "./components/AdminMain/commentAdmin.php";
                break;
        };
        ?>
    </div>
    <script src="https://kit.fontawesome.com/ec4ae96e25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>