<?php 
$host = "localhost";
$username = "root";
$password = "";
$db_name = "xshop";

$connect = new mysqli($host, $username, $password, $db_name);

if ($connect->connect_error) {
    die("Connection failed: ". $connect->connect_error);
}

mysqli_set_charset($connect, "utf8");