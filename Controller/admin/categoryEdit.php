<?php
require("../../connectDB.php");

if (isset($_POST['editCatSubmit']) && isset($_FILES['CategoryEditImg']) && isset($_POST['CategoryEditName'])) {
    global $connect;
    $delImg = $_POST['CategoryEditOldImg'];
    $id  = $_POST['editCatSubmit'];
    $img_name = $_FILES['CategoryEditImg']['name'];
    $error = $_FILES['CategoryEditImg']['error'];
    $tmp_name = $_FILES['CategoryEditImg']['tmp_name'];
    $catName = $_POST['CategoryEditName'];
    if ($error == 0) {

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_path = 'upload/' . $new_img_name;
        $img_upload_path = '../../upload/' . $new_img_name;

        $sql = "UPDATE category SET CategoryName = '$catName', ImagePath = '$img_path' WHERE `Id` = $id";
        $result = mysqli_query($connect, $sql);
        move_uploaded_file($tmp_name, $img_upload_path);
        unlink('../../'.$delImg);
        header("Location: ../../admin.php?page=danhmuc");
    }
}
