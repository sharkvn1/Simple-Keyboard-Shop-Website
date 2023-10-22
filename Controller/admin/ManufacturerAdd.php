<?php
require("../../connectDB.php");
if (isset($_POST['addManufacturerSubmit'])) {
    global $connect;
    $ManufacturerName = $_POST['ManufacturerName'];
    $db = "INSERT INTO manufacturer (ManufacturerName) VALUES('$ManufacturerName')";
    mysqli_query($connect, $db);
    header("Location: ../../admin.php?page=nhasanxuat");
}
?>