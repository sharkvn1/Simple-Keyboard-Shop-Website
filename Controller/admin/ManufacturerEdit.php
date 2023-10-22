<?php
require("../../connectDB.php");
if (isset($_POST['ManufacturerEditSubmit'])) {
    global $connect;
    $id = $_POST['ManufacturerEditSubmit'];
    $ManufacturerName = $_POST['ManufacturerEditName'];
    $db = "UPDATE manufacturer SET ManufacturerName = '$ManufacturerName' WHERE `Id` = $id";
    mysqli_query($connect, $db);
    header("Location: ../../admin.php?page=nhasanxuat");
}
