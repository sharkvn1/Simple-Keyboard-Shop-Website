<?php
require("../../connectDB.php");

if (isset($_POST['addCatSubmit']) && isset($_FILES['CategoryImg']) && isset($_POST['CategoryName'])) {
    global $connect;
    $img_name = $_FILES['CategoryImg']['name'];
    $error = $_FILES['CategoryImg']['error'];
    $tmp_name = $_FILES['CategoryImg']['tmp_name'];
    $catName = $_POST['CategoryName'];
    if ($error == 0) {

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_path = 'upload/' . $new_img_name;
        $img_upload_path = '../../upload/' . $new_img_name;

        move_uploaded_file($tmp_name, $img_upload_path);

        $sql = "INSERT INTO category (CategoryName, ImagePath) VALUES('$catName','$img_path')";
        $result = mysqli_query($connect, $sql);
        header("Location: ../../admin.php?page=danhmuc");
    }
}
?>