<?php
require("../../connectDB.php");

if (isset($_POST['CategoryDelete'])) {
    global $connect;
    $id = $_POST['CategoryDelete'];
    $delImg = $_POST['CategoryDeleteImg'];
    $db = "DELETE FROM `Category` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        unlink('../../'.$delImg);
        header('Location: ../../admin.php?page=danhmuc');
    }
}
