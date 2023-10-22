<?php
require("../../connectDB.php");

if (isset($_POST['ProductDelete'])) {
    global $connect;
    $delImg = $_POST['ProductDeleteImg'];
    $id = $_POST['ProductDelete'];
    $db = "DELETE FROM `product` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        unlink('../../' . $delImg);
        header('Location: ../../admin.php?page=sanpham');
    }
}

?>