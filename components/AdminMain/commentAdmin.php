<?php
require_once "./data.php";

use function database\CommentPage;
use function database\GetData;
use function database\GetDataById;
?>
<div class="container-comment">
    <?php
    if (CommentPage() !== false) :
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
    <?php
        endwhile;
    endif;
    ?>
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