<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <title>Add User</title>
</head>

<body>
    <div class="container">
        <?php

        require_once("Class.Tool.php");

        $pdo = Database::connect();

        if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {

            $sName = Tools::cleanData($_POST['sname']);

            $semail = Tools::cleanData($_POST['semail']);
            $spassword = md5(Tools::cleanData($_POST['spass']));
            $sgender = Tools::cleanData($_POST['gender']);
            $sAdmin = Tools::cleanData($_POST['isAdmin']);

            $file_name = $_FILES['photo']['name'];

            $tmp_file = $_FILES['photo']['tmp_name'];
            $ext = explode(".", $file_name);
            $extention = end($ext);
            $array_extention = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG");
            $target = "uploads/";

            if (!in_array($extention, $array_extention)) {
                Tools::printError('Extention not allow!!! just jpg or png or jpeg');
            }

            move_uploaded_file($tmp_file, $target . $file_name);
            $select = "SELECT * FROM users WHERE email = '$semail'";

            $result = $pdo->query($select);

            if ($result->rowCount() > 0) {
                Tools::printError('email already exist!!!!Try Again');
            } else {
                try {
                    $add = "INSERT INTO users(name, email, password, image, gender,isAdmin) VALUES('$sName','$semail','$spassword','$file_name',' $sgender','$sAdmin')";
                    $pdo->query($add);

                    echo "<div class='alert alert-success alert-dismissable'>";
                    echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                    echo "<strong>Success!</strong> Added Successfully";
                    echo "   <a href ='AdminPage.php'>Go back</a>";
                    echo "</div>";
                } catch (Exception $e) {
                    echo "<div class='alert alert-danger alert-dismissable'>";
                    echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                    echo "<strong>ERROR!</strong> {$e->getMessage()}</div>";
                }
            }
        }


        ?>


        <div>
            <form method="post" name="myform" enctype="multipart/form-data">


                <div class="form-group">
                    <label class="control-label">User Name:</label>
                    <input type="text" name="sname" required class="form-control" value="">
                </div>
                <br />

                <div class="form-group">
                    <label class="control-label">User Email:</label>
                    <input type="text" name="semail" class="form-control" value="">
                </div>
                <br />

                <div class="form-group">
                    <label class="control-label">password:</label>
                    <input type="text" name="spass" class="form-control" value="">
                </div>
                <br />

                <div class="form-group">
                    <label for="photo">Select image:</label>
                    <input id="photo" type="file" name="photo" required>
                </div>
                <br />

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                </div>
                <br />

                <div class="form-group">
                    <label for="gender">isAdmin:</label>
                    <select id="gender" name="isAdmin">
                        <option value="1">User</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
                <br />

                <div class="form-group">
                    <input type="submit" name="submit" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>




</body>

</html>