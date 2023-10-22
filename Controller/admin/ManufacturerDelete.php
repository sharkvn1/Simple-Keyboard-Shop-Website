<?php
require("../../connectDB.php");

if (isset($_POST['ManufacturerDelete'])) {
    global $connect;
    $id = $_POST['ManufacturerDelete'];
    $db = "DELETE FROM `manufacturer` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ../../admin.php?page=nhasanxuat');
    }
}
?>