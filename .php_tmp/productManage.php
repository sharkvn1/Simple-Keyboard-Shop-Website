<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/ec4ae96e25.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<?php
require "./function.php";

use function extFunction\get_client_ip;
use function extFunction\GetCategory;
use function extFunction\GetProduct;
use function extFunction\PageProduct;

if (isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] === get_client_ip()) {
} else {
  header('Location: ./login.html');
}
?>

<body>

  <!-- navbar - just for fun i do this for no reason don't care about it -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">I DON'T KNOW HOW TO MAKE LOGO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="#">Just stand here for nothing</a>
          <a class="nav-link" href="#">Same here</a>
          <a class="nav-link" href="#">Same here</a>
          <a class="nav-link disabled" aria-disabled="true">Same here</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- CURD -->
  <div class="main">

    <!-- QuantityBox -->
    <div class="QuantityBox">
      <ul class="list-group countBox">
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">Category</div>
            Number of category available
          </div>
          <span class="badge bg-primary rounded-pill"><?php echo mysqli_num_rows(GetCategory()); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">Product</div>
            Number of product available
          </div>
          <span class="badge bg-primary rounded-pill">
            <?php echo GetProduct() ? GetProduct()->num_rows : 0 ?>
          </span>
        </li>
      </ul>

      <!-- Open Add Modal -->
      <div class="d-grid gap-2 mt-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CategoryModal">Add More Category</button>
      </div>
      <div class="d-grid gap-2 mt-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProductModal">Add More Product</button>
      </div>

      <!-- Add Category Modal -->
      <div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="CategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="CategoryModalLabel">Add Category</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="./function.php">
              <div class="modal-body">
                <div class="mb-3">
                  <label for="" class="form-label">Category Name</label>
                  <input type="text" class="form-control" name="category_name" placeholder="New Category Name" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Add Product Modal -->
      <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="ProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ProductModalLabel">Add Product</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="./function.php">
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Product Name</label>
                  <input type="text" class="form-control" name="product_name" placeholder="New Product Name" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">CategoryID</label>
                  <input type="text" class="form-control" name="categoryID" placeholder="New Product CategoryID" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Product Brand</label>
                  <input type="text" class="form-control" name="product_brand" placeholder="New Product Brand" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Product Price</label>
                  <input type="text" class="form-control" name="product_price" placeholder="New Product Price" required>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Product Image</label>
                  <input type="file" class="form-control" name="product_image" placeholder="New Product Image" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Container -->
    <div class="Main_Container">

      <!-- Page navigation -->
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li class="page-item">
            <form method="get">
              <button class="page-link" name="prev" value="prev" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </button>
          </li>
          <?php
          $productNum = ceil(GetProduct()->num_rows / 6);
          for ($i = 0; $i < $productNum; $i++) :
          ?>
            <li class="page-item">
              <button class="page-link" name="page" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
            </li>
          <?php endfor; ?>
          <li class="page-item">
            <button class="page-link" name="next" value="next" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </button>
          </li>
          </form>
        </ul>
      </nav>

      <!-- Product Page -->
      <div>
        <!-- Product Card -->
        <div class="row">
          <?php $data = PageProduct();
          while ($row = mysqli_fetch_assoc($data)) :
          ?>
            <div class="col-sm-5 mb-3 mb-sm-0 productCard">
              <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="./img/<?= $row['Image'] ?>" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['Name'] ?></h5>
                      <h6 class="card-text">Brand: <?= $row['Brand'] ?></h6>
                      <h6 class="card-text">Price: <?= $row['Price'] ?></h6>
                      <form method="get" class="d-grid gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditProductModal<?= $row['Id'] ?>">Edit Product Information</button>
                        <button class="btn btn-danger" name="delete_product" value="<?= $row['Id'] ?>">Delete Product</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Edit Product Modal -->
            <div class="modal fade" id="EditProductModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="EditProductModalLabel<?= $row['Id'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="EditProductModalLabel<?= $row['Id'] ?>">Edit Product Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post" action="./function.php">
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="new_product_name" placeholder="New Product Name">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">CategoryID</label>
                        <input type="text" class="form-control" name="new_categoryID" placeholder="New Product CategoryID">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Product Brand</label>
                        <input type="text" class="form-control" name="new_product_brand" placeholder="New Product Brand">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" class="form-control" name="new_product_price" placeholder="New Product Price">
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="new_product_image" placeholder="New Product Image">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="edit_product_btn" value="<?= $row['Id'] ?>">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

      </div>

    </div>

</body>
<style>
  body {
    height: 100vh;
  }

  .main {
    padding: 50px 100px 0px 100px;
    display: flex;
    gap: 100px
  }

  .QuantityBox {
    min-width: 300px;
    height: max-content;
  }

  .productCard {
    min-width: 600px;
  }
</style>

</html>