<?php
require_once "./data.php";

use function database\GetData;
use function database\UserPage;
?>

<div class="container">
    <?php
    $data = UserPage();
    while ($row = $data->fetch_assoc()) :
    ?>
        <div class="card" style="width: 300px; height: 440px; display: flex; align-items: center;">
            <img src="./<?php echo $row['ImagePath'] ?>" class="card-img-top" alt="..." style="border-radius: 100px; width: 180px; margin-top: 5px" height="180">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['Username'] ?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Tên Đầy Đủ: <?php if (!$row['Fullname']) echo 'Vô Danh';
                                                        else echo $row['Fullname'] ?></li>
                <li class="list-group-item">Email: <?php echo $row['Email'] ?></li>
                <li class="list-group-item">Vai Trò: <?php if ($row['UserRole'] == 1) echo 'Quản Trị VIên';
                                                        else echo 'Khách Hàng'; ?></li>
            </ul>
            <div class="card-body">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UserEditModal<?php echo $row['Id'] ?>">Edit</a>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#UserDeleteModal<?php echo $row['Id'] ?>">Delete</a>
            </div>
        </div>
        <!-- DeleteManufacturer Modal -->
        <form method="post" action="./Controller/admin/userDelete.php" class="modal fade" id="UserDeleteModal<?php echo $row['Id'] ?>" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
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
        <form method="post" action="./Controller/admin/userEdit.php" class="modal fade" id="UserEditModal<?php echo $row['Id'] ?>" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="UserEditLabel">Chỉnh Sửa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Vai Trò</label>
                            <input type="text" class="form-control" id="userRole" name="userRole">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success" name="UserEdit" value="<?php echo $row['Id'] ?>">Lưu</button>
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