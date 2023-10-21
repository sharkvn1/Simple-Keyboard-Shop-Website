<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="d-flex flex-column  justify-content-center align-items-center">
    <script type="text/javascript">
        var count = 5;
        var redirectUrl = "./index.php";

        function countdown() {
            if (count <= 0) {
                window.location.href = redirectUrl;
            } else {
                document.getElementById('countdown').innerHTML = count;
                count--;
                setTimeout(countdown, 1000);
            }
        }
        window.onload = function() {
            countdown();
        };
    </script>
    <h1 style="color: green">Successful Login</h1>
    <h2>Redirect you to homepage in <span id="countdown">5</span> seconds...</h2>
</body>

</html>