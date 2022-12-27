<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <title>Update User</title>
</head>

<body>
    <div class="container">
        <?php

        require_once("Class.Tool.php");

        $pdo = Database::connect();

        if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
            $sID = Tools::cleanData($_POST['sid']);
            $select = "SELECT * FROM users WHERE id = '$sID'";

            $result = $pdo->query($select);
            $bring = $result->fetch(PDO::FETCH_ASSOC);
            $cpassword = $bring["password"];
            $word = Tools::cleanData($_POST['spass']);
            if ($cpassword != $word)
                $spassword = md5(Tools::cleanData($_POST['spass']));
            else
                $spassword = Tools::cleanData($_POST['spass']);
            $sName = Tools::cleanData($_POST['sname']);

            $semail = Tools::cleanData($_POST['semail']);

            $sgender = Tools::cleanData($_POST['gender']);
            $sAdmin = Tools::cleanData($_POST['isAdmin']);



            $sql = "update users set name=? ,email=?,password=?,gender=?,isAdmin=? where id=?";
            $result = $pdo->prepare($sql);
            try {
                $result->execute(array($sName, $semail, $spassword, $sgender, $sAdmin, $sID));
                echo "<div class='alert alert-success alert-dismissable'>";
                echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                echo "<strong>Success!</strong> Updated Successfully";
                echo "   <a href ='AdminPage.php'>Go back</a>";
                echo "</div>";
            } catch (Exception $e) {
                echo "<div class='alert alert-danger alert-dismissable'>";
                echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                echo "<strong>ERROR!</strong> {$e->getMessage()}</div>";
            }
        }

        $sql = "select * from users where id=?";
        $result = $pdo->prepare($sql);
        $result->execute(array($_POST['sid']));
        $user = $result->fetch(PDO::FETCH_ASSOC);
        ?>


        <div>
            <form method="post" name="myform">

                <div class="form-group">
                    <label class="control-label">User ID:</label>
                    <input readonly="readonly" type="text" name="sid" class="form-control" placeholder="User id" value="<?php echo $user['id']; ?>">
                </div>
                <br />
                <div class="form-group">
                    <label class="control-label">User Name:</label>
                    <input type="text" name="sname" required class="form-control" value="<?php echo $user['name']; ?>">
                </div>
                <br />

                <div class="form-group">
                    <label class="control-label">User Email:</label>
                    <input type="text" name="semail" class="form-control" value="<?php echo $user['email']; ?>">
                </div>
                <br />

                <div class="form-group">
                    <label class="control-label">password:</label>
                    <input type="text" name="spass" class="form-control" value="<?php echo $user['password']; ?>">
                </div>
                <br />


                <br />

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="<?php echo $user['gender']; ?>"><?php echo $user['gender']; ?></option>
                        <option value="<?php echo $user['gender'] == 'male' ? 'female' : 'male'; ?>"><?php echo $user['gender'] == 'male' ? 'female' : 'male'; ?></option>
                    </select>
                </div>
                <br />

                <div class="form-group">
                    <label for="gender">isAdmin:</label>
                    <select id="gender" name="isAdmin">
                        <option value="<?php echo $user['isAdmin']; ?>"><?php echo $user['isAdmin'] == 1 ? "User" : "Admin" ?></option>
                        <option value="<?php echo $user['isAdmin'] == "1" ? "2" : "1"; ?>"><?php echo $user['isAdmin'] == "1" ? "Admin" : "user" ?></option>
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