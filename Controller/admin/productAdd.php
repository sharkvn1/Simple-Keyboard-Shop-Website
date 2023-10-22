<?php
require("../../connectDB.php");


if (isset($_POST['addProductSubmit'])) {
    global $connect;
    $img_name = $_FILES['ProductImage']['name'];
    $error = $_FILES['ProductImage']['error'];
    $tmp_name = $_FILES['ProductImage']['tmp_name'];
    $proName = $_POST['ProductName'];
    $proPrice = $_POST['ProductPrice'];
    $proCategory = $_POST['ProductCategory'];
    $proManufacturer = $_POST['ProductManufacturer'];
    $proDescription = $_POST['ProductDescription'];
    $proQuantity = $_POST['ProductQuantity'];
    $proSpecialStatus = $_POST['ProductSpecialStatus'];
    if ($error == 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_path = 'upload/' . $new_img_name;
        $img_upload_path = '../../upload/' . $new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        $sql = "INSERT INTO product (ProductName, ImagePath, Price, IdCategory, IdManufacturer, ProductDescriptions, Quantity, SpecialStatus) VALUES('$proName','$img_path', '$proPrice', '$proCategory', '$proManufacturer', '$productDescription', '$proQuantity', '$proSpecialStatus')";
        mysqli_query($connect, $sql);
        header("Location: ../../admin.php?page=sanpham");
    } 
}

?>