<?php
require("connectDB.php");

if (isset($_POST['CategoryDelete'])) {
    global $connect;
    $id = $_POST['CategoryDelete'];
    $db = "DELETE FROM `Category` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ./admin/admin.php?page=danhmuc');
    }
}

?>