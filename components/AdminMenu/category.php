<div>
    <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategory">Thêm Danh Mục</a>
    <form action="./Controller/admin/categoryAdd.php" method="post" class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true" enctype="multipart/form-data">
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