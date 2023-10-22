<?php
require("../connectDB.php");
require("../data.php");

use function database\GetDataById;

if (isset($_POST['AvaSubmit'])) {
    global $connect;
    $id = $_POST['AvaSubmit'];
    $img_name = $_FILES['avaChange']['name'];
    $tmp_name = $_FILES['avaChange']['tmp_name'];
    $delImg = $_POST['oldAva'];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_path = 'upload/' . $new_img_name;
    $img_upload_path = '../upload/' . $new_img_name;

    $sql = "UPDATE users SET ImagePath = '$img_path' WHERE `Id` = $id";
    $connect->query($sql);
    move_uploaded_file($tmp_name, $img_upload_path);
    if ($delImg != 'img/deAva.jpg') {
        unlink('../' . $delImg);
    }
    header("Location: ../Account.php");
}

if (isset($_POST['InfoChange'])) {
    $id = $_POST['InfoChange'];

    $data = GetDataById('users', $id);
    
    $username = $_POST['NewUserName'];
    if($username == ''){
        $username = $data['Username'];
    }
    $mail = $_POST['NewEmail'];
    if($mail == ''){
        $mail = $data['Email'];
    }
    $password = $_POST['NewPassword'];
    if($password == ''){
        $password = $data['Password'];
    }
    $fullname = $_POST['NewFullname'];
    if($fullname == ''){
        $fullname = $data['Fullname'];
    }

    $sql = "UPDATE users SET Username = '$username', Email = 'Email', `Password` = '$password', Fullname = '$fullname' WHERE `Id` = $id";
    $connect->query($sql);
    header("Location: ../Account.php");
}
