<?php
require_once("Class.Tool.php");
session_start();
class login
{
    static function checkIn($email, $password)
    {
        $email = Tools::cleanData($email);
        $password = md5(Tools::cleanData($password));


        $conn = Database::connect();
        $select = "select * FROM users WHERE email = ? and password = ?";
        $result = $conn->prepare($select);
        $result->execute(array($email, $password));

        if ($result->rowCount() > 0) {
            $bring = $result->fetch(PDO::FETCH_ASSOC);
            if($bring["isAdmin"]=="2")
            $_SESSION["isAdmin"]="yes";
            $_SESSION['id'] = $bring['id'];
            $_SESSION['name'] = $bring['name'];
            $_SESSION['photo'] = $bring['image'];
            Database::disconnect();
            if ($bring["isAdmin"] == "2") {
                header("location:AdminPage.php");
            } else {
                header("location:userPage.php");
            }
        } else {
            header("location:loginPage.php?loginError=1");
        }
    }
}
