<?php

namespace fun; ?>
<?php
require("connectDB.php");
require("data.php");
use function database\GetDataById;
use function database\GetUserId;

function login_auth($username, $password)
{
    global $connect;
    $db = "SELECT * FROM `users`";
    $data = mysqli_query($connect, $db);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            if ($username == $row['Username'] && $password == $row['Password'] || $username == $row['Email'] && $password == $row['Password']) {
                $id = GetUserId($username);
                $role = GetDataById('users',$id)['Role'];
                setcookie("is_logged_in", $id, time() + 3600, '/');
                setcookie("is_admin", $role, time() + 3600, '/');
                header('Location: ./index.php');
            } else {
                return "Wrong username/mail or password";
            }
        }
    }
}

if (isset($_POST['btn_reg'])) {
    $username = test_input($_POST['Reg_username']);
    $password = test_input($_POST['Reg_password']);
    $mail = test_input($_POST['Reg_mail']);

    $db = "INSERT INTO `users` (`Username`, `Password`, `Email`) VALUES('$username', '$password', '$mail')";

    if ($connect->query($db) === true) {
        $id = GetUserId($username);
        $role = GetDataById('users',$id)['Role'];
        setcookie("is_logged_in", $id, time() + 3600, '/');
        setcookie("is_admin", $role, time() + 3600, '/');
        header('Location: ./index.php');
    }
}

if (isset($_GET['logout'])) {
    setcookie("is_logged_in", '', time() - 3600, '/');
    setcookie("is_admin", '', time() - 3600, '/');
    header('Location: ./index.php');
}

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

if(isset($_GET['adminPage'])){
    $page = $_GET['adminPage'];
    header('Location: ./admin/admin.php?page=' . $page);
}

?>