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
    } else {
        return false;
    }
}

function PriceFormat($price)
{
    $formattedPrice = number_format($price);
    return $formattedPrice;
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

function GetDataById($table, $id)
{
    global $connect;
    $db = "SELECT * FROM $table WHERE `Id` = $id";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        $a = mysqli_fetch_assoc($data);
        return $a;
    }
}

function GetCategoryProduct($id){
    global $connect;
    $db = "SELECT * FROM product WHERE `IdCategory` = $id";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        return $data;
    } else {
        return false;
    }
}

function GetProductCategoryNumber($id){
    global $connect;
    $db = "SELECT IdCategory FROM product WHERE `IdCategory` = $id";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        $a = mysqli_num_rows($data);
        return $a;
    } else {
        return 0;
    }
}

function GetProductManufacturerNumber($id)
{
    global $connect;
    $db = "SELECT IdManufacturer FROM product WHERE `IdManufacturer` = $id";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        $a = mysqli_num_rows($data);
        return $a;
    } else {
        return 0;
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

if (isset($_POST['addManufacturerSubmit'])) {
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
    if (GetData('product') !== false) {
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
    if (GetData('comment') !== false) {
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
        return $data;
    } else {
        return false;
    }
}
