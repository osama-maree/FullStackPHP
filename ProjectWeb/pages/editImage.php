<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Image</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>
    <?php
    require_once("Class.Tool.php");

    if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
        $sID = $_POST['sid'];

        $file_name = $_FILES['photo']['name'];
        $tmp_file = $_FILES['photo']['tmp_name'];
        $ext = explode(".", $file_name);
        $extention = end($ext);
        $array_extention = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG");
        $target = "uploads/";

        if (!in_array($extention, $array_extention)) {
            Tools::printError('Extention not allow!!! just jpg or png or jpeg');
        }
        $file_name = $sID . "." . $extention;
        move_uploaded_file($tmp_file, $target . $file_name);
        $conn = Database::connect();

        try {
            $sql = "update users set image='$file_name' where id='$sID'";
            $conn->query($sql);
            echo "<div class='alert alert-success alert-dismissable'>";
            echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            echo "<strong>Success!</strong> Updated Successfully";
            echo "   <a href ='AdminPage.php'>Go back</a>";
            echo "</div>";
        } catch (Exception $e) {
            echo "<div class='alert alert-danger alert-dismissable'>";
            echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            echo "<strong>ERROR!</strong> Error</div>";
        }
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label">User ID:</label>
            <input readonly="readonly" type="text" name="sid" class="form-control" placeholder="User id" value=<?php echo $_POST["sid"] ?>>
        </div>
        <br />
        <div class="form-group">
            <label for="formGroupExampleInput">Select image:</label>
            <input type="file" name="photo" required class="form-control" id="formGroupExampleInput" placeholder="Example input">
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Save" class="btn btn-success">
        </div>
    </form>

</body>

</html>