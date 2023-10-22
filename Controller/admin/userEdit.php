<?php
require("../../connectDB.php");
if (isset($_POST['UserEdit'])) {
    global $connect;
    $id = $_POST['UserEdit'];
    $userRole = $_POST['userRole'];
    $db = "UPDATE users SET UserRole = '$userRole' WHERE `Id` = $id";
    if ($connect->query($db) === true) {
        header("Location: ../../admin.php?page=nguoidung");
    }
}
