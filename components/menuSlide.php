<?php
require_once "./data.php";

use function database\GetData;
?>
<div class="menu-slide">
    <?php
    $data = GetData('category');
    while ($row = mysqli_fetch_assoc($data)) :
        $path = $row['ImagePath'];
        $name = $row['CategoryName'];
        $id = $row['Id'];
    ?>
        <form action="./categoryClick.php" method="get">
            <button type='submit' name='btn' value='<?= $id ?>'>
                <img src='./<?= $path ?>' alt='menu-logo' />
                <p><?= $name ?></p>
            </button>
        </form>
    <?php endwhile; ?>
    </form>
</div>