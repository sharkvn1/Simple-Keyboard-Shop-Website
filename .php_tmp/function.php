<?php

namespace extFunction;

require("databaseConnect.php");

//*get data
function GetCategory()
{
    global $connect;
    $db = "SELECT `Name` FROM `category`";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        return $data;
    }
}

function GetProduct()
{
    global $connect;
    $db = "SELECT * FROM `product`";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        return $data;
    } else {
        return false;
    }
}

function PageProduct()
{
    global $connect;
    $itemsPerPage = 6;
    $totalPage = ceil(GetProduct()->num_rows / 6);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if (isset($_GET['prev']) && $page > 1) {
        $page = -1;
    } elseif (isset($_GET['next']) && $page < $totalPage) {
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

//*change data
if (isset($_POST['edit_product_btn'])) {
    $productID = $_POST['edit_product_btn'];
    global $connect;

    $db = "SELECT * FROM `product` where `ID` = $productID";
    $data = mysqli_query($connect, $db);
    $product = mysqli_fetch_array($data);

    $name = $product["Name"];
    $category = $product["CategoryID"];
    $brand = $product["Brand"];
    $price = $product["Price"];
    $image = $product["Image"];

    if (isset($_POST['new_product_name']) && strlen($_POST['new_product_name']) > 2) {
        $name = $_POST['new_product_name'];
    }
    if (isset($_POST['new_categoryID'])&& strlen($_POST['new_categoryID']) > 2) {
        $category = $_POST['new_categoryID'];
    }
    if (isset($_POST['new_product_brand']) && strlen($_POST['new_product_brand']) > 2) {
        $brand = $_POST['new_product_brand'];
    }
    if (isset($_POST['new_product_price'])&& strlen($_POST['new_product_price']) > 2) {
        $price = $_POST['new_product_price'];
    }
    if (isset($_POST['new_product_image'])&& strlen($_POST['new_product_image']) > 2) {
        $image = $_POST['new_product_image'];
    }
    $db = "UPDATE `product` SET `Name` = '$name', `CategoryID` = '$category', `Brand` = '$brand', `Price` = '$price', `Image` = '$image' WHERE `Id` = $productID";
    if ($connect->query($db) === true) {
        header('Location: ./productManage.php');
        return;
    } else {
        echo "error {$db}" . $connect->error;
    }
}

//*delete data
if(isset($_GET['delete_product'])){
    global $connect;
    $productID = $_GET['delete_product'];
    $db = "DELETE FROM `product` WHERE `Id` = $productID";
    $connect->query($db);
}

//*new data create
if (isset($_POST['add_category_btn'])) {
    $CategoryName = $_POST['category_name'];
    $CategoryID = "ca" . mysqli_num_rows(GetCategory()) + 1;
    $data = "INSERT INTO `category` (`CategoryID`, `Name`) VALUES('$CategoryID', '$CategoryName')";
    global $connect;
    if ($connect->query($data) === true) {
        header('Location: ./productManage.php');
    } else {
        echo "error {$db}" . $connect->error;
    }
}

if (isset($_POST['add_product_btn'])) {
    $ProductName = $_POST['product_name'];
    $Category = $_POST['categoryID'];
    $Brand = $_POST['product_brand'];
    $Price = $_POST['product_price'];
    $Image = $_POST['product_image'];
    global $connect;
    $data = "INSERT INTO `product` (`Name`, `CategoryID`, `Brand`, `Price`, `Image`) VALUES('$ProductName', '$Category', '$Brand', '$Price', '$Image')";

    if ($connect->query($data) === true) {
        header('Location: ./productManage.php');
    } else {
        echo "error {$db}" . $connect->error;
    }
}

//*some other function
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function test_input($data_test)
{
    $data_return = trim($data_test);
    $data_return = stripslashes($data_test);
    $data_return = htmlspecialchars($data_test);
    return $data_return;
}
