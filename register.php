<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/register-login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>register</title>
</head>

<body class="d-flex flex-column gap-3 justify-content-center align-items-center bg-dark ">
    <div class="regForm">
        <h1>Register</h1>
        <form action="./function.php" id="register" method="post" class="w-75 h-75 needs-validation" novalidate>
            <div class="mb-2">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="Reg_username" placeholder="your username" required minlength="5">
                <div class="invalid-feedback">Tên đăng nhập phải có ít nhất
                    5 ký tự</div>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="Reg_password" placeholder="your password" required>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
            </div>
            <div class="mb-2">
                <label for="confirm_password" class="form-label">Confirm
                    Password</label>
                <input type="password" id="confirm_password" class="form-control" name="Reg_confirm_password" placeholder="Confirm your password" required>
                <div class="invalid-feedback">Mật khẩu không khớp!</div>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Email</label>
                <input type="email" id="mail" class="form-control" name="Reg_mail" placeholder="abc@mail.com" required>
                <div class="invalid-feedback">Vui lòng điền email</div>
            </div>
            <div class="d-grid gap-2 mb-2">
                <button type="submit" name="btn_reg" value="btnReg" class="btn btn-primary">Register</button>
            </div>
        </form>
        <p>Already have an account? <a href="./login.php">Login Here!</a></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#register").submit(function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                var password = $("#password").val();
                var confirmPassword = $("#confirm_password").val();
                if (password !== confirmPassword) {
                    event.preventDefault();
                    $("#confirm_password")[0].setCustomValidity("Mật khẩu không khớp!");
                } else {
                    $("#confirm_password")[0].setCustomValidity("");
                }
                this.classList.add("was-validated");
            });
        });
    </script>
</body>

</html>