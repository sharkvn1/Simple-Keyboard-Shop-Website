<?php

namespace database;

require("connectDB.php");

function GetData($tablet)
{
    global $connect;
    $db = "SELECT * FROM $tablet";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        return $data;
    }
}

function GetUserId($mail_username)
{
    global $connect;
    $db = "SELECT `id` FROM `users` WHERE `username` = '$mail_username' OR `email` = '$mail_username'";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        $a = mysqli_fetch_array($data);
        return $a['id'];
    }
}


function GetDataById($table,$id)
{
    global $connect;
    $db = "SELECT * FROM $table WHERE `Id` = $id";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        $a = mysqli_fetch_assoc($data);
        return $a;
    }
}


if(isset($_POST['CategoryDelete'])){
    global $connect;
    $id = $_POST['CategoryDelete'];
    $db = "DELETE FROM `Category` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if($connect->query($db) === true){
        header('Location: ./admin/admin.php?page=danhmuc');
    }
}

if (isset($_POST['ProductDelete'])) {
    global $connect;
    $id = $_POST['ProductDelete'];
    $db = "DELETE FROM `product` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ./admin/admin.php?page=sanpham');
    }
}

if (isset($_POST['ManufacturerDelete'])) {
    global $connect;
    $id = $_POST['ManufacturerDelete'];
    $db = "DELETE FROM `manufacturer` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ./admin/admin.php?page=nhasanxuat');
    }
}

if (isset($_POST['UserDelete'])) {
    global $connect;
    $id = $_POST['UserDelete'];
    $db = "DELETE FROM `users` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ./admin/admin.php?page=nguoidung');
    }
}

if (isset($_POST['CommentDelete'])) {
    global $connect;
    $id = $_POST['CommentDelete'];
    $db = "DELETE FROM `comment` WHERE `id` = $id";
    $result = mysqli_query($connect, $db);
    if ($connect->query($db) === true) {
        header('Location: ./admin/admin.php?page=binhluan');
    }
}

if(isset($_POST['addCatSubmit']) && isset($_FILES['CategoryImg']) && isset($_POST['CategoryName'])) {
    print_r($_FILES['CategoryImg']);
    global $connect;
    $img_name = $_FILES['CategoryImg']['name'];
    $error = $_FILES['CategoryImg']['error'];
    $tmp_name = $_FILES['CategoryImg']['tmp_name'];
    $catName = $_POST['CategoryName'];
    if($error == 0){

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        
        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_path = 'upload/' . $new_img_name;
        $img_upload_path = 'upload/' . $new_img_name;

        move_uploaded_file($tmp_name, $img_upload_path);

        $sql = "INSERT INTO category (CategoryName, ImagePath) VALUES('$catName','$img_path')";
        $result = mysqli_query($connect, $sql);
        header("Location: ./admin/admin.php?page=danhmuc");
    }
}

if(isset($_POST['addProductSubmit'])){
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
        $img_upload_path = 'upload/' . $new_img_name;

        move_uploaded_file($tmp_name, $img_upload_path);

        $sql = "INSERT INTO product (ProductName, ImagePath, Price, IdCategory, IdManufacturer, ProductDescriptions, Quantity, SpecialStatus) VALUES('$proName','$img_path', '$proPrice', '$proCategory', '$proManufacturer', '$productDescription', '$proQuantity', '$proSpecialStatus')";
        mysqli_query($connect, $sql);
        header("Location: ./admin/admin.php?page=sanpham");
    }
}

if(isset($_POST['addManufacturerSubmit'])){
    global $connect;
    $ManufacturerName = $_POST['ManufacturerName'];
    $db = "INSERT INTO manufacturer (ManufacturerName) VALUES('$ManufacturerName')";
    mysqli_query($connect, $db);
    header("Location: ./admin/admin.php?page=nhasanxuat");
}

function CategoryPage()
{
    global $connect;
    $itemsPerPage = 8;
    $totalPage = ceil(GetData('category')->num_rows / 8);
    $page = isset($_GET['CatPage']) ? $_GET['CatPage'] : 1;
    if (isset($_GET['CatPrev']) && $page > 1) {
        $page = -1;
    } 
    if (isset($_GET['CatNext']) && $page < $totalPage) {
        $page = +1;
    }
    $startFrom = ($page - 1) * $itemsPerPage;
    $db = "SELECT * FROM `category` LIMIT $startFrom, $itemsPerPage";
    $data = mysqli_query($connect, $db);
    if ($data->num_rows > 0) {
        return $data;
    } else {
        return false;
    }
}

function ProductPage()
{
    global $connect;
    $itemsPerPage = 8;
    $totalPage = ceil(GetData('product')->num_rows / 6);
    $page = isset($_GET['ProPage']) ? $_GET['ProPage'] : 1;
    if (isset($_GET['ProPrev']) && $page > 1) {
        $page = -1;
    } elseif (isset($_GET['ProNext']) && $page < $totalPage) {
        $page = +1;
    }
    $startFrom = ($page - 1) * $itemsPerPage;
    $db = "SELECT * FROM `product` LIMIT $startFrom, $itemsPerPage";
    $data = mysqli_query($connect, $db);
    if ($data->num_rows > 0) {
        return $data;
    } else {
        return false;
    }
}

function ManufacturerPage()
{
    global $connect;
    $itemsPerPage = 8;
    $totalPage = ceil(GetData('manufacturer')->num_rows / 12);
    $page = isset($_GET['ManPage']) ? $_GET['ManPage'] : 1;
    if (isset($_GET['ManPrev']) && $page > 1) {
        $page = -1;
    } elseif (isset($_GET['ManNext']) && $page < $totalPage) {
        $page = +1;
    }
    $startFrom = ($page - 1) * $itemsPerPage;
    $db = "SELECT * FROM `manufacturer` LIMIT $startFrom, $itemsPerPage";
    $data = mysqli_query($connect, $db);
    if ($data->num_rows > 0) {
        return $data;
    } else {
        return false;
    }
}

function UserPage()
{
    global $connect;
    $itemsPerPage = 8;
    $totalPage = ceil(GetData('users')->num_rows / 8);
    $page = isset($_GET['UserPage']) ? $_GET['UserPage'] : 1;
    if (isset($_GET['UserPrev']) && $page > 1) {
        $page = -1;
    } elseif (isset($_GET['UserNext']) && $page < $totalPage) {
        $page = +1;
    }
    $startFrom = ($page - 1) * $itemsPerPage;
    $db = "SELECT * FROM `users` LIMIT $startFrom, $itemsPerPage";
    $data = mysqli_query($connect, $db);
    if ($data->num_rows > 0) {
        return $data;
    } else {
        return false;
    }
}

function CommentPage()
{
    global $connect;
    $itemsPerPage = 8;
    $totalPage = ceil(GetData('comment')->num_rows / 6);
    $page = isset($_GET['ComPage']) ? $_GET['ComPage'] : 1;
    if (isset($_GET['ComPrev']) && $page > 1) {
        $page = -1;
    } elseif (isset($_GET['ComNext']) && $page < $totalPage) {
        $page = +1;
    }
    $startFrom = ($page - 1) * $itemsPerPage;
    $db = "SELECT * FROM `comment` LIMIT $startFrom, $itemsPerPage";
    $data = mysqli_query($connect, $db);
    if ($data->num_rows > 0) {
        return $data;
    } else {
        return false;
    }
}