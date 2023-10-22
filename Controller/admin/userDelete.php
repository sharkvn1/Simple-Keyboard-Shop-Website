<?php
require("../../connectDB.php");
if (isset($_POST['UserDelete'])) {
    global $connect;
    $id = $_POST['UserDelete'];
    $db = "DELETE FROM `users` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ../../admin.php?page=nguoidung');
    }
}
