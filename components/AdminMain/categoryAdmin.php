<?php
require_once "./data.php";

use function database\GetData;
use function database\CategoryPage;
use function database\GetProductCategoryNumber;
?>

<div class="container">
    <?php
    $data = CategoryPage();
    while ($row = $data->fetch_assoc()) :
    ?>
        <div class="card" style="width: 240px; height: 400px;">
            <img src="./<?php echo $row['ImagePath'] ?>" class="card-img-top" alt="thumbnail">

            <div class="card-body">
                <h5 class="card-title"><?php echo $row['CategoryName'] ?></h5>
                <p class="card-text">Số lượng sản phẩm trong danh mục: <?= GetProductCategoryNumber($row['Id']); ?> </p>
                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editCategory<?= $row['Id'] ?>">Edit</a>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#CategoryDeleteModal<?= $row['Id'] ?>">Delete</a>
            </div>
        </div>
        <!-- DeleteCategory Modal -->
        <form method="post" action="./Controller/admin/categoryDelete.php" class="modal fade" id="CategoryDeleteModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="CategoryDeleteLabel">Xóa Danh Mục</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn Có Chắc Muốn Xóa Danh Mục Không
                    </div>
                    <input type="text" hidden name="CategoryDeleteImg" value="<?= $row['ImagePath'] ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                        <button type="submit" class="btn btn-danger" name="CategoryDelete" value="<?= $row['Id'] ?>">Có</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="./Controller/admin/categoryEdit.php" method="post" class="modal fade" id="editCategory<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editCategoryLabel">Thêm Danh Mục</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="CategoryEditName" class="form-label">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="CategoryName" name="CategoryEditName">
                        </div>
                        <div class="mb-3">
                            <label for="CategoryEditImage" class="form-label">Ảnh Danh Mục</label>
                            <input class="form-control" type="file" id="CategoryEditImage" name="CategoryEditImg">
                        </div>
                        <input type="text" name="CategoryEditOldImg" hidden value="<?= $row['ImagePath'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="editCatSubmit" value="<?= $row['Id'] ?>">Save changes</button>
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