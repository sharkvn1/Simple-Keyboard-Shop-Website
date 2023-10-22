<?php
require_once "./data.php";

use function database\GetData;
?>
<div>
    <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#AddProduct">Thêm Sản Phẩm</a>
    <form action="./Controller/admin/productAdd.php" method="post" class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true" enctype="multipart/form-data">
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