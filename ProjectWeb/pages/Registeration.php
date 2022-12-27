<?php
session_start();
require_once('Class.Tool.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = Database::connect();
    $first_name = Tools::cleanData($_POST['first_name']);
    $last_name = Tools::cleanData($_POST['last_name']);
    $email = Tools::cleanData($_POST['email']);
    $name1 = $first_name . " " . $last_name;
    $password1 = md5(Tools::cleanData($_POST['password']));
    $confirmPassword = md5(Tools::cleanData($_POST['cpassword']));
    $gender = $_POST['gender'];

    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $tmp_file = $_FILES['photo']['tmp_name'];
    $ext = explode(".", $file_name);
    $extention = end($ext);
    $array_extention = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG");
    $target = "uploads/";
    if (!in_array($extention, $array_extention)) {
        Tools::printError('Extention not allow!!! just jpg or png or jpeg');
    }
    $file_name = $email . "." . $extention;
    move_uploaded_file($tmp_file, $target . $file_name);


    $select = "SELECT * FROM users WHERE email = '$email'";

    $result = $conn->query($select);

    if ($result->rowCount() > 0) {
        header("location:register.php?EError=1");
    } else {
        if ($password1 !=  $confirmPassword) {
            header("location:register.php?RError=1");
        } else {
            $add = "INSERT INTO users(name, email, password, image, gender) VALUES('$name1','$email','$password1','$file_name','$gender')";
            $conn->query($add);
            $select_1 = "SELECT * FROM users WHERE email = '$email'";
            $res = $conn->query($select_1);

            $bring = $res->fetch(PDO::FETCH_ASSOC);


            $_SESSION["id"] = $bring["id"];
            $_SESSION['name'] = $name1;
            $_SESSION['photo'] = $file_name;
            header("location:userPage.php");
        }
    }
}
