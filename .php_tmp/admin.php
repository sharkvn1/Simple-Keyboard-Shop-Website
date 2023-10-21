<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    require "../data.php";


    use function database\CategoryPage;
    use function database\ProductPage;
    use function database\ManufacturerPage;
    use function database\UserPage;
    use function database\CommentPage;
    use function database\GetData;
    use function database\GetDataById;

    $page = $_GET['page'] ?? "danhmuc";
    ?>
    <nav class="nav-main navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid Main-nav">
            <a class="navbar-brand" href="#">
                <img src="../img/logo-removebg.png" alt="logo" width="121" height="44">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
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

    <div class="main">
        <div class="menu">
            <p>Menu box</p>
            <div class="list-group">
                <a href="../function.php?adminPage=danhmuc" class="list-group-item list-group-item-action <?php if ($page == 'danhmuc') echo 'active'  ?>  " aria-current="true">
                    Danh mục
                </a>
                <a href="../function.php?adminPage=sanpham" class="list-group-item list-group-item-action <?php if ($page == 'sanpham') echo 'active'  ?>  ">Sản Phẩm</a>
                <a href="../function.php?adminPage=nhasanxuat" class="list-group-item list-group-item-action <?php if ($page == 'nhasanxuat') echo 'active'  ?>  ">Nhà Sản Xuất</a>
                <a href="../function.php?adminPage=nguoidung" class="list-group-item list-group-item-action <?php if ($page == 'nguoidung') echo 'active'  ?>  ">Người Dùng</a>
                <a href="../function.php?adminPage=binhluan" class="list-group-item list-group-item-action <?php if ($page == 'binhluan') echo 'active'  ?>  ">Bình Luận</a>
            </div>
            <?php
            switch ($page):
                default:
            ?>
                    <div>
                        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategory">Thêm Danh Mục</a>
                        <form action="../data.php" method="post" class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true" enctype="multipart/form-data">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addCategoryLabel">Thêm Danh Mục</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="CategoryName" class="form-label">Tên Danh Mục</label>
                                            <input type="text" class="form-control" id="CategoryName" name="CategoryName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="CategoryImage" class="form-label">Ảnh Danh Mục</label>
                                            <input class="form-control" type="file" id="CategoryImage" name="CategoryImg">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="addCatSubmit">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php break;
                case 'sanpham': ?>
                    <div>
                        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#AddProduct">Thêm Sản Phẩm</a>
                        <form action="../data.php" method="post" class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true" enctype="multipart/form-data">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addProductLabel">Thêm Sản Phẩm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="ProductName" class="form-label">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" id="ProductName" name="ProductName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProductPrice" class="form-label">Giá Sản Phẩm</label>
                                            <input type="text" class="form-control" id="ProductPrice" name="ProductPrice">
                                        </div>
                                        <label for="ProductCategory" class="form-label">Nhà Sản Xuất Sản Phẩm</label>
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Category Select" name="ProductCategory" id="ProductCategory">
                                                <option selected>Select Category</option>
                                                <?php
                                                $data = GetData('category');
                                                while ($row = $data->fetch_assoc()) :
                                                ?>
                                                    <option value="<?php echo $row['Id'] ?>"><?php echo $row['CategoryName'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProductManufacturer" class="form-label">Nhà Sản Xuất Sản Phẩm</label>
                                            <select class="form-select" aria-label="Manufacturer Select" name="ProductManufacturer" id="ProductManufacturer">
                                                <option selected>Select Manufacturer</option>
                                                <?php
                                                $data = GetData('manufacturer');
                                                while ($row = $data->fetch_assoc()) :
                                                ?>
                                                    <option value=" <?php echo $row['Id'] ?>"><?php echo $row['ManufacturerName'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProductDescription" class="form-label">Mô Tả Về Sản Phẩm</label>
                                            <textarea type="text" class="form-control" id="ProductDescription" name="ProductDescription"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProductQuantity" class="form-label">Số Lượng Sản Phẩm</label>
                                            <input type="text" class="form-control" id="ProductQuantity" name="ProductQuantity">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProductSpecialStatus" class="form-label">Trạng Thái Đặc Biệt</label>
                                            <input type="text" class="form-control" id="ProductSpecialStatus" name="ProductSpecialStatus">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ProductImage" class="form-label">Ảnh Sản Phẩm</label>
                                            <input class="form-control" type="file" id="ProductImage" name="ProductImage">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="addProductSubmit">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    < <?php break;
                    case 'nhasanxuat': ?> <div>
                        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addManufacturer">Thêm Nhà Sản Xuất</a>
                        <form action="../data.php" method="post" class="modal fade" id="addManufacturer" tabindex="-1" aria-labelledby="addManufacturerLabel" aria-hidden="true" enctype="multipart/form-data">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addManufacturerLabel">Thêm Nhà Sản Xuất</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="ManufacturerName" class="form-label">Tên Nhà Sản Xuất</label>
                                            <input type="text" class="form-control" id="ManufacturerName" name="ManufacturerName">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="addManufacturerSubmit">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
        </div>
    <?php break;
                    case 'nguoidung':
    ?> <?php break;
                    case 'binhluan': ?> <?php endswitch; ?>
    </div>

    <?php
    switch ($page):
        default:
    ?>
            <div class="container">
                <?php
                $data = CategoryPage();
                while ($row = $data->fetch_assoc()) :
                ?>
                    <div class="card" style="width: 240px; height: 400px;">
                        <img src="../<?php echo $row['ImagePath'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['CategoryName'] ?></h5>
                            <p class="card-text">Số lượng sản phẩm trong danh mục: </p>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#CategoryDeleteModal<?= $row['Id'] ?>">Delete</a>
                        </div>
                    </div>
                    <!-- DeleteCategory Modal -->
                    <form method="post" action="../data.php" class="modal fade" id="CategoryDeleteModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="CategoryDeleteLabel">Xóa Danh Mục</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn Có Chắc Muốn Xóa Danh Mục Không
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="submit" class="btn btn-danger" name="CategoryDelete" value="<?= $row['Id'] ?>">Có</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <form method="get">
                            <button class="page-link" name="CatPrev" value="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                    </li>
                    <?php
                    $CategoryNum = ceil(GetData('category')->num_rows / 8);
                    for ($i = 0; $i < $CategoryNum; $i++) :
                    ?>
                        <li class="page-item">
                            <button class="page-link" name="CatPage" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <button class="page-link" name="CatNext" value="next" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                    </form>
                </ul>
            </nav>
        <?php
            break;
        case 'sanpham':
        ?>
            <div class="container">
                <?php
                $data = ProductPage();
                while ($row = $data->fetch_assoc()) :
                ?>
                    <div class="card" style="width: 240px; height: 600px;">
                        <img src="../<?php echo $row['ImagePath'] ?>" class="card-img-top" alt="logo">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["ProductName"] ?></h5>
                            <p class="card-text"><?php echo $row['Price'] ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Giảm Giá: <?php echo $row['Discount'] ?></li>
                            <li class="list-group-item">Danh Mục: <?php echo GetDataById('category', $row['IdCategory'])['CategoryName'] ?></li>
                            <li class="list-group-item">Hãng Sản Xuất: <?php echo GetDataById('manufacturer', $row['IdManufacturer'])['ManufacturerName'] ?></li>
                            <li class="list-group-item">Lượt xem: <?php echo $row['View'] ?></li>
                        </ul>
                        <div class="card-body">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProductEditModal<?= $row['Id'] ?>">Edit</a>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ProductDeleteModal<?= $row['Id'] ?>">Delete</a>
                        </div>
                    </div>
                    <!-- DeleteProduct Modal -->
                    <form method="post" action="../data.php" class="modal fade" id="ProductDeleteModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ProductDeleteLabel">Xóa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn Có Chắc Muốn Xóa Không
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="submit" class="btn btn-danger" name="ProductDelete" value="<?= $row['Id'] ?>">Có</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="post" action="../data.php" class="modal fade" id="ProductEditModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ProductEditLabel">Xóa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="ProductEditName" class="form-label">Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" id="ProductName" name="ProductName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ProductEditPrice" class="form-label">Giá Sản Phẩm</label>
                                        <input type="text" class="form-control" id="ProductPrice" name="ProductPrice">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ProductEditDescription" class="form-label">Mô Tả Về Sản Phẩm</label>
                                        <textarea type="text" class="form-control" id="ProductDescription" name="ProductDescription"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ProductEditQuantity" class="form-label">Số Lượng Sản Phẩm</label>
                                        <input type="text" class="form-control" id="ProductQuantity" name="ProductQuantity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ProductEditSpecialStatus" class="form-label">Trạng Thái Đặc Biệt</label>
                                        <input type="text" class="form-control" id="ProductSpecialStatus" name="ProductSpecialStatus">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ProductEditImage" class="form-label">Ảnh Sản Phẩm</label>
                                        <input class="form-control" type="file" id="ProductImage" name="ProductImage">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="submit" class="btn btn-danger" name="ProductEdit" value="<?= $row['Id'] ?>">Có</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <form method="get">
                            <button class="page-link" name="ProPrev" value="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                    </li>
                    <?php
                    $ProductNum = ceil(GetData('product')->num_rows / 6);
                    for ($i = 0; $i < $ProductNum; $i++) :
                    ?>
                        <li class="page-item">
                            <button class="page-link" name="ProPage" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <button class="page-link" name="ProNext" value="next" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                    </form>
                </ul>
            </nav>
        <?php
            break;
        case 'nhasanxuat':
        ?>
            <div class="container-Manufacturer">
                <?php
                $data = ManufacturerPage();
                while ($row = $data->fetch_assoc()) :
                ?>
                    <div class="card" style="width: 240px; height: 180px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['ManufacturerName'] ?></h5>
                            <p class="card-text">Số lượng sản phẩm của nhà sản xuất: </p>
                            <a class="btn btn-primary">Edit</a>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ManufacturerDeleteModal">Delete</a>
                        </div>
                    </div>
                    <!-- DeleteManufacturer Modal -->
                    <form method="post" action="../data.php" class="modal fade" id="ManufacturerDeleteModal" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ManufacturerDeleteLabel">Xóa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn Có Chắc Muốn Xóa Không
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="submit" class="btn btn-danger" name="ManufacturerDelete" value="<?php echo $row['Id'] ?>">Có</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <form method="get">
                            <button class="page-link" name="CatePrev" value="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                    </li>
                    <?php
                    $CategoryNum = ceil(GetData('manufacturer')->num_rows / 12);
                    for ($i = 0; $i < $CategoryNum; $i++) :
                    ?>
                        <li class="page-item">
                            <button class="page-link" name="ManPage" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <button class="page-link" name="ManNext" value="next" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                    </form>
                </ul>
            </nav>
        <?php
            break;
        case 'nguoidung':
        ?>
            <div class="container">
                <?php
                $data = UserPage();
                while ($row = $data->fetch_assoc()) :
                ?>
                    <div class="card" style="width: 300px; height: 440px; display: flex; align-items: center;">
                        <img src="../<?php echo $row['ImagePath'] ?>" class="card-img-top" alt="..." style="border-radius: 100px; width: 180px; margin-top: 5px" height="180">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['Username'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tên Đầy Đủ: <?php if (!$row['Fullname']) echo 'Vô Danh';
                                                                    else echo $row['Fullname'] ?></li>
                            <li class="list-group-item">Email: <?php echo $row['Email'] ?></li>
                            <li class="list-group-item">Vai Trò: <?php if ($row['Role'] == 1) echo 'Quản Trị VIên';
                                                                    else echo 'Khách Hàng'; ?></li>
                        </ul>
                        <div class="card-body">
                            <a class="btn btn-primary">Edit</a>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#UserDeleteModal">Delete</a>
                        </div>
                    </div>
                    <!-- DeleteManufacturer Modal -->
                    <form method="post" action="../data.php" class="modal fade" id="UserDeleteModal" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="UserDeleteLabel">Xóa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn Có Chắc Muốn Xóa Không
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="submit" class="btn btn-danger" name="UserDelete" value="<?php echo $row['Id'] ?>">Có</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <form method="get">
                            <button class="page-link" name="CatePrev" value="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                    </li>
                    <?php
                    $CategoryNum = ceil(GetData('manufacturer')->num_rows / 8);
                    for ($i = 0; $i < $CategoryNum; $i++) :
                    ?>
                        <li class="page-item">
                            <button class="page-link" name="ManPage" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <button class="page-link" name="ManNext" value="next" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                    </form>
                </ul>
            </nav>
        <?php
            break;
        case 'binhluan':
        ?>
            <div class="container-comment">
                <?php
                $data = CommentPage();
                while ($row = $data->fetch_assoc()) :
                ?>
                    <div class="card" style="width:1400px; height:230px">
                        <h5 class="card-header">
                            <img src="../<?php echo GetDataById('users', $row['UserId'])['ImagePath'] ?>" alt="ava" width="40" height="40" style="border-radius:100px">
                            Bình luận của <?php echo GetDataById('users', $row['UserId'])['Username'] ?> về sản phẩm <?php echo GetDataById('product', $row['ProductId'])['ProductName'] ?>
                            <img src="../<?php echo GetDataById('product', $row['ProductId'])['ImagePath'] ?>" alt="ava" width="40" height="40" style="border-radius:100px" />
                        </h5>
                        <div class="card-body">
                            <p class="card-text"><?php $cmt = $row['CommentContent'];
                                                    if (strlen($cmt) > 700) $cmt = substr($cmt, 0, 700) . "...";
                                                    echo $cmt;  ?></p>
                        </div>
                        <div class="card-body ms-auto ">
                            <a id="cmt-btn" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#UserDeleteModal">Delete</a>
                        </div>
                    </div>
                    <!-- DeleteManufacturer Modal -->
                    <form method="post" action="../data.php" class="modal fade" id="UserDeleteModal" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="UserDeleteLabel">Xóa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn Có Chắc Muốn Xóa Không
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                    <button type="submit" class="btn btn-danger" name="UserDelete" value="<?php echo $row['Id'] ?>">Có</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <form method="get">
                            <button class="page-link" name="CatePrev" value="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                    </li>
                    <?php
                    $CategoryNum = ceil(GetData('manufacturer')->num_rows / 12);
                    for ($i = 0; $i < $CategoryNum; $i++) :
                    ?>
                        <li class="page-item">
                            <button class="page-link" name="ManPage" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <button class="page-link" name="ManNext" value="next" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                    </form>
                </ul>
            </nav>
            <?php
            break;
            ?>
    <?php endswitch; ?>
    </div>



    <script src="https://kit.fontawesome.com/ec4ae96e25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>