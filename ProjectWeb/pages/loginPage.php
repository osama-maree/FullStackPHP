<?php
require 'Class.login.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    login::checkIn($_POST['email'], $_POST['pswd']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style/login.css" />
    <title>Login Form</title>

</head>

<body>

    <?php
    if (isset($_GET['loginError'])) {

        Tools::printError('خطأ في تسجيل الدخول');
    }

    ?>

    <div class="main">
        <div class="login">
            <form method="post">
                <input type="email" name="email" placeholder="Email" required="" />
                <input type="password" name="pswd" placeholder="Password" required="" />
                <button>Login</button>
            </form>

        </div>
        <div class="secend"> don't have an account?<a href="register.php">register now</a></div>
    </div>

</body>

</html>