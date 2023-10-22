<?php
require_once "./data.php";

use function database\GetData;
use function database\ManufacturerPage;
use function database\GetProductManufacturerNumber;
?>
<div class="container-Manufacturer">
    <?php
    $data = ManufacturerPage();
    while ($row = $data->fetch_assoc()) :
    ?>
        <div class="card" style="width: 240px; height: 180px;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['ManufacturerName'] ?></h5>
                <p class="card-text">Số lượng sản phẩm của nhà sản xuất: <?= GetProductManufacturerNumber($row['Id']) ?></p>
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ManufacturerEditModal<?= $row['Id'] ?>">Edit</a>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ManufacturerDeleteModal<?= $row['Id'] ?>">Delete</a>
            </div>
        </div>
        <!-- DeleteManufacturer Modal -->
        <form method="post" action="./Controller/admin/manufacturerDelete.php" class="modal fade" id="ManufacturerDeleteModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
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
                        <button type="submit" class="btn btn-danger" name="ManufacturerDelete" value="<?= $row['Id'] ?>">Có</button>
                    </div>
                </div>
            </div>
        </form>
        <form method="post" action="./Controller/admin/manufacturerEdit.php" class="modal fade" id="ManufacturerEditModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ManufacturerEditLabel">Chỉnh Sửa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ManufacturerEditName" class="form-label">Tên Nhà Sản Xuất</label>
                            <input type="text" class="form-control" id="ManufacturerName" name="ManufacturerEditName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success" name="ManufacturerEditSubmit" value="<?= $row['Id'] ?>">Lưu</button>
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