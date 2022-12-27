<?php
require_once('Class.Tool.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
  require 'Registeration.php';




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
  <title>Register Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../style/style.css" />
</head>

<body>
  <?php
  if (isset($_GET['RError'])) {
    Tools::printError('password not matched!');
  }
  if (isset($_GET["EError"]))
    Tools::printError('email already exist!!!!Try Again');

  ?>
  <div class="signup-form">
    <form action="" method="post" enctype="multipart/form-data">
      <h2>Register</h2>
      <p class="hint-text">Create account</p>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-6"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
          <div class="col-xs-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="photo">Select image:</label>
        <input id="photo" type="file" name="photo" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required="required">
      </div>

      <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
          <option value="male">male</option>
          <option value="female">female</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success btn-lg btn-block" value="reg" name="submit">Register Now</button>
      </div>
    </form>
    <div class="text-center">Already have an account? <a href="loginPage.php">Sign in</a></div>
  </div>
</body>

</html>