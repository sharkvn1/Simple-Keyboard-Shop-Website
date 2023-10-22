<?php
require_once "./data.php";

use function database\ProductPage;
use function database\GetDataById;
use function database\GetData;
use function database\PriceFormat;
?>
<style>
    .card-body-text {
        height: 125px;
        text-align: center;
    }

    .card-body-btn {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .card-body-btn a {
        width: 80px;
        height: 40px;
    }
</style>
<div class="container">
    <?php
    $data = ProductPage();
    if ($data !== false) :
        while ($row = $data->fetch_assoc()) :
    ?>
            <div class="card" style="width: 240px; height: 600px;">
                <div style="width: 238px; height: 238px; display: flex; align-items: center;">
                    <img src="./<?php echo $row['ImagePath'] ?>" class="card-img-top" alt="logo">
                </div>
                <div class="card-body card-body-text">
                    <h4 class="card-title" style="font-weight:700"><?php echo $row["ProductName"] ?></h4>
                    <h5 class="card-text"><?= PriceFormat($row['Price']) ?>₫</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Giảm Giá: <?php echo $row['Discount'] ?>%</li>
                    <li class="list-group-item">Danh Mục: <?php echo GetDataById('category', $row['IdCategory'])['CategoryName'] ?></li>
                    <li class="list-group-item">Hãng Sản Xuất: <?php echo GetDataById('manufacturer', $row['IdManufacturer'])['ManufacturerName'] ?></li>
                    <li class="list-group-item">Lượt xem: <?php echo $row['View'] ?></li>
                </ul>
                <div class="card-body card-body-btn">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProductEditModal<?= $row['Id'] ?>">Edit</a>
                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ProductDeleteModal<?= $row['Id'] ?>">Delete</a>
                </div>
            </div>
            <!-- DeleteProduct Modal -->
            <form method="post" action="./Controller/admin/productDelete.php" class="modal fade" id="ProductDeleteModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ProductDeleteLabel">Xóa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn Có Chắc Muốn Xóa Không
                        </div>
                        <input type="text" hidden name="ProductDeleteImg" value="<?= $row['ImagePath'] ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                            <button type="submit" class="btn btn-danger" name="ProductDelete" value="<?= $row['Id'] ?>">Có</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php require_once "./components/AdminModal/productEditModal.php" ?>
    <?php endwhile;
    endif; ?>
</div>
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item">
            <form method="get">
                <button class="page-link" name="ProPrev" value="prev" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </button>
            </form>
        </li>
        <?php
        if (GetData('product') !== false) :
            $ProductNum = ceil(GetData('product')->num_rows / 6);
            for ($i = 0; $i < $ProductNum; $i++) :
        ?>
                <li class="page-item">
                    <button class="page-link" name="ProPage" value="<?= $i + 1 ?>"><?php echo $i + 1; ?></button>
                </li>
        <?php endfor;
        endif;
        ?>
        <form method="get">
            <li class="page-item">
                <button class="page-link" name="ProNext" value="next" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </button>
            </li>
        </form>
    </ul>
</nav>