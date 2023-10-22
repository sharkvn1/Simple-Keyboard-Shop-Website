<?php
require("../../connectDB.php");

if (isset($_POST['ProductEditSubmit'])) {
    global $connect;
    $id = $_POST['ProductEditId'];
    $delImg = $_POST['ProductEditOldImg'];
    $img_name = $_FILES['ProductEditImage']['name'];
    $error = $_FILES['ProductEditImage']['error'];
    $tmp_name = $_FILES['ProductEditImage']['tmp_name'];

    $ProductEditName = $_POST['ProductEditName'];
    $ProductEditPrice = $_POST['ProductEditPrice'];
    $ProductEditCategory = $_POST['ProductEditCategory'];
    $ProductEditManufacturer = $_POST['ProductEditManufacturer'];
    $ProductEditDescription = $_POST['ProductEditDescription'];
    $ProductEditQuantity = $_POST['ProductEditQuantity'];
    $ProductEditSpecialStatus = $_POST['ProductEditSpecialStatus'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_path = 'upload/' . $new_img_name;
    $img_upload_path = '../../upload/' . $new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);

    $sql = "UPDATE product SET ProductName = '$ProductEditName', ImagePath = '$img_path', Price = '$ProductEditPrice', IdCategory = '$ProductEditCategory', IdManufacturer = '$ProductEditManufacturer',ProductDescriptions = '$ProductEditDescription' ,Quantity = '$ProductEditQuantity', SpecialStatus = '$ProductEditSpecialStatus' WHERE `Id` = 11";
    mysqli_query($connect, $sql);
    move_uploaded_file($tmp_name, $img_upload_path);
    unlink('../../' . $delImg);
    header("Location: ../../admin.php?page=sanpham");
}