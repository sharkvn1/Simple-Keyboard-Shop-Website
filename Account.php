<?php
require_once "./data.php";

use function database\GetDataById;

$id = $_COOKIE['is_logged_in'];

$data = GetDataById('users', $id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php require_once "./components/navbar.php" ?>
    <div class="account-container">
        <div class="account-main">
            <h3>Tổng Quan</h3>
            <div class="acc-top-text">
                <div>
                    <p id="Title">Tên Đăng Nhập</p>
                    <p id="info-text"><?= $data['Username'] ?></p>
                </div>
                <div>
                    <p id="Title">Email</p>
                    <p id="info-text"><?= $data['Email'] ?></p>
                </div>
                <div>
                    <p id="Title">Họ và Tên</p>
                    <p id="info-text"><?php if ($data['Fullname'] == '') {
                                            echo "vô danh";
                                        } else {
                                            echo $data['Fullname'];
                                        } ?></p>
                </div>
                <div>
                    <p id="Title">Vai Trò</p>
                    <p id="info-text"><?php if ($data['UserRole'] == 0) echo "Khách Hàng";
                                        else echo "Quản Trị Viên" ?></p>
                </div>
                <div>
                    <p id="Title">Ngày Tham Gia</p>
                    <p id="info-text"><?= $data['DateAdd'] ?></p>
                </div>
            </div>
            <hr>
            <div class="ava-container">
                <img src="./<?= $data['ImagePath']; ?>" alt="">
                <form action="./Controller/userInfoUpdate.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="file" id="formFile" name="avaChange">
                    <input type="text" name="oldAva" hidden value="<?= $data['ImagePath']; ?>">
                    <button type="submit" class="btn btn-primary" name="AvaSubmit" value="<?= $id ?>">Submit</button>
                </form>
                <div class=" vertical-line">
                </div>
                <div>
                    <p>Vui lòng chọn ảnh nhỏ hơn 5MB</p>
                    <p>Chọn hình ảnh phù hợp, không phản cảm</p>
                </div>
            </div>
            <hr>
            <p style="font-weight: 700; font-size: 26px">Thay Đổi Thông Tin</p>
            <div class="info-change">
                <form action="./Controller/userInfoUpdate.php" method="post">
                    <div class="mb-3">
                        <label for="NewUserName" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" class="form-control" id="NewUserName" name="NewUserName">
                    </div>
                    <div class="mb-3">
                        <label for="NewEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="NewEmail" name="NewEmail">
                    </div>
                    <div class="mb-3">
                        <label for="NewPassword" class="form-label">Password</label>
                        <input type="text" class="form-control" id="NewPassword" name="NewPassword">
                    </div>
                    <div class="mb-3">
                        <label for="NewFullname" class="form-label">Họ Và Tên</label>
                        <input type="text" class="form-control" id="NewFullname" name="NewFullname">
                    </div>
                    <button type="submit" class="btn btn-primary" name="InfoChange" value="<?= $id ?>">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>
    <script src="https://kit.fontawesome.com/ec4ae96e25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>