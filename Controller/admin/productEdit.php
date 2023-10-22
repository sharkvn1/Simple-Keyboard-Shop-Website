<?php
require_once "../../data.php";
use function database\GetDataById;
require("../../connectDB.php");

if (isset($_POST['ProductEditSubmit'])) {
    global $connect;
    $id = $_POST['ProductEditId'];
    $delImg = $_POST['ProductEditOldImg'];
    $img_name = $_FILES['ProductEditImage']['name'];
    $error = $_FILES['ProductEditImage']['error'];
    $tmp_name = $_FILES['ProductEditImage']['tmp_name'];

    $data = GetDataById('product', $id);
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

    $sql = "UPDATE product SET ProductName = 'Fantasy', ImagePath = '$img_path', Price = '$ProductEditPrice', IdCategory = '$ProductEditCategory', IdManufacturer = '$ProductEditManufacturer',ProductDescriptions = '$ProductEditDescription' ,Quantity = '$ProductEditQuantity', SpecialStatus = '$ProductEditSpecialStatus' WHERE `Id` = $id";
    if ($connect->query($sql) === true) {
        if ($tmp_name != '') {
            move_uploaded_file($tmp_name, $img_upload_path);
            unlink('../../' . $delImg);
        }
        header("Location: ../../admin.php?page=sanpham");
    }
}
