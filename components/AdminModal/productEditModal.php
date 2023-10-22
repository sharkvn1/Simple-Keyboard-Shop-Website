<?php
require_once "./data.php";

use function database\GetData;
?>
<form method="post" action="./Controller/admin/productEdit.php" class="modal fade" id="ProductEditModal<?= $row['Id'] ?>" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true" enctype="multipart/form-data">
    <input type="text" name="ProductEditOldImg" hidden value="<?= $row['ImagePath'] ?>">
    <input type="text" name="ProductEditId" hidden value="<?= $row['Id'] ?>">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ProductEditLabel">Chỉnh Sửa Sản Phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="ProductEditName" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" class="form-control" id="ProductEditName" name="ProductEditName">
                </div>
                <div class="mb-3">
                    <label for="ProductEditPrice" class="form-label">Giá Sản Phẩm</label>
                    <input type="text" class="form-control" id="ProductEditPrice" name="ProductEditPrice">
                </div>
                <label for="ProductEditCategory" class="form-label">Nhà Sản Xuất Sản Phẩm</label>
                <div class="mb-3">
                    <select class="form-select" aria-label="Category Select" name="ProductEditCategory" id="ProductEditCategory">
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
                    <label for="ProductEditManufacturer" class="form-label">Nhà Sản Xuất Sản Phẩm</label>
                    <select class="form-select" aria-label="Manufacturer Select" name="ProductEditManufacturer" id="ProductEditManufacturer">
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
                    <label for="ProductEditDescription" class="form-label">Mô Tả Về Sản Phẩm</label>
                    <textarea type="text" class="form-control" id="ProductDescription" name="ProductEditDescription"></textarea>
                </div>
                <div class="mb-3">
                    <label for="ProductEditQuantity" class="form-label">Số Lượng Sản Phẩm</label>
                    <input type="text" class="form-control" id="ProductQuantity" name="ProductEditQuantity">
                </div>
                <div class="mb-3">
                    <label for="ProductEditSpecialStatus" class="form-label">Trạng Thái Đặc Biệt</label>
                    <input type="text" class="form-control" id="ProductSpecialStatus" name="ProductEditSpecialStatus">
                </div>
                <div class="mb-3">
                    <label for="ProductEditImage" class="form-label">Ảnh Sản Phẩm</label>
                    <input class="form-control" type="file" id="ProductImage" name="ProductEditImage">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-success" name="ProductEditSubmit">Lưu</button>
            </div>
        </div>
    </div>
</form>