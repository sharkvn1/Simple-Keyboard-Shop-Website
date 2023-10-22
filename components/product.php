<?php
require_once "./data.php";

use function database\GetData;
use function database\GetDataById;
use function database\PriceFormat;
?>
<div class="main-text">
    <h1>Sản Phẩm Của Chúng Tôi</h1>
</div>
<div class="main-container">
    <?php
    $data = GetData('product');

    if ($data  !== false) :
        while ($row = mysqli_fetch_assoc($data)) :
    ?>
            <div class="card">
                <div class="card-top">
                    <img src="./<?= $row['ImagePath'] ?>" alt="" id="ImgCard">
                    <div class="card-top-text">
                        <div class="badge bg-primary rounded-pill">
                            <p>-<?= $row['Discount'] ?>%</p>
                        </div>
                        <div class="top-text">
                            <p style="text-align: center;"><?= GetDataById('category', $row['IdCategory'])['CategoryName']; ?></p>
                            <p style="text-align: center;"><?= $row['ProductName'] ?></p>
                        </div>
                        <div>
                            <p style="text-align: center; text-decoration: line-through; margin-top:3px; color:gray"> <?= PriceFormat($row['Price']) ?>₫</p>
                            <?php
                            $a = $row['Price'];
                            $b = $a - (($row['Price'] * $row['Discount']) / 100);
                            $price = PriceFormat($b);
                            ?>
                            <p style="text-align: center;"><?= $price ?>₫</p>
                        </div>
                        <div>
                            <div class=" cart bg-primary">
                                <i class="fa-solid fa-cart-plus cart-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endwhile;
    endif;
    ?>
</div>