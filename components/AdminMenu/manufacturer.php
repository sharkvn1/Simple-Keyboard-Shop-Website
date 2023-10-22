<div>
    <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addManufacturer">Thêm Nhà Sản Xuất</a>
    <form action="./Controller/admin/ManufacturerAdd.php" method="post" class="modal fade" id="addManufacturer" tabindex="-1" aria-labelledby="addManufacturerLabel" aria-hidden="true" enctype="multipart/form-data">
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