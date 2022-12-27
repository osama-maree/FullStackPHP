<?php
require_once("userPage.php");

$conn = Database::connect();
$cid = $_SESSION['id'];
$select = "select * from users where id != $cid";
$users = $conn->prepare($select);
$users->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <title>Document</title>
</head>

<body>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Image</th>
        <th>Gender</th>
      </tr>
    </thead>
    <tbody id="data">
      <?php
      while ($user = $users->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['password']}</td>";
        echo "<td>{$user['image']}</td>";
        echo "<td>{$user['gender']}</td>";
        echo "<td><form method='post'>";
        echo "<input type='hidden' value='{$user['id']}' name='sid'/>";
        echo "<input type='submit' value='Edit' formaction='sedit.php' class='btn btn-warnning'>";
        echo "<input type='submit' value='Delete' formaction='deleteuser.php' class='btn btn-warnning'>";
        echo "<input type='submit' value='Edit Image' formaction='editImage.php' class='btn btn-warnning'>";
        echo "</form></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</body>

</html>