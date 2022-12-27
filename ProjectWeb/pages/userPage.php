<?php


session_start();
require_once("Class.Tool.php");
if (!isset($_SESSION['name'])) {
  header('location:loginPage.php');
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UserPage</title>
  <link rel="stylesheet" href="../style/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->


  <style>
    .error {
      display: none;
    }

    .middle button a {
      text-decoration: none;
      color: #000;
    }

    .middle button:hover {
      background-color: black;


    }

    .middle button a:hover {
      color: white !important;
    }

    .middle {
      display: flex;
      justify-content: space-around
    }
  </style>
</head>

<body>

  <?php
  $conn = Database::connect();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = Tools::cleanData($_POST['name']);
    $auther = Tools::cleanData($_POST['auther']);
    $number_of_Page = Tools::cleanData($_POST['number']);
    $price = Tools::cleanData($_POST['price']);

    if ($name && $auther && $number_of_Page && $price) {
      $id = $_SESSION["id"];

      $add = "INSERT INTO books(user_id,name,auther,numberPage,Price)VALUES('$id','$name','$auther','$number_of_Page','$price')";
      $conn->query($add);
      echo "<div class='alert alert-success alert-dismissable'>";
      echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
      echo "<strong>Success!</strong> added Successfully";
      echo "</div>";
    } else {
      echo "<div class='alert alert-danger alert-dismissable'>";
      echo "<a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
      echo "<strong>Fail!</strong> Added Failed";
      echo "</div>";
    }
  }

  $select = "select * from books";
  $books = $conn->prepare($select);
  $books->execute();
  ?>
  <!-- section username and image -->

  <div class="middle">
    <button type="button" class="btn btn-danger" data-mdb-ripple-color="dark" style="z-index: 1;">
      <a href="logout.php"> Logout</a>
    </button>
    <div class="right">
      <button type="submit" value="delete" class="btn btn-success"> <a href="DeleteAccount.php"> Delete My Account</a></button>
      <?php if (isset($_SESSION['isAdmin']))
        echo '<button type="submit" id="adminadd" class="btn btn-success"><a href="AddUser.php">add User</a></button>' ?>

    </div>
  </div>

  <section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="<?php echo 'uploads/' . $_SESSION['photo'] ?>" alt="" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1;max-width:150px;max-height:200px;">
                <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                  <?php echo   $_SESSION['name'] ?>
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!--end section-->


  <header class="text-center container">
    <div class="d-flex align-content-center justify-content-center justify-content-between">
      <div class="w-50 me-5">
        <img class="w-75" src="../img/book.jpg" alt="book house" />
      </div>
    </div>
  </header>
  <section class="ms-5 me-5 text-center">
    <div class="row">
      <div class="col-7 me-5">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name of the book</th>
              <th>Auther</th>
              <th>Number of pages</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody id="data">
            <?php
            while ($book = $books->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              echo "<td>{$book['id']}</td>";
              echo "<td>{$book['name']}</td>";
              echo "<td>{$book['auther']}</td>";
              echo "<td>{$book['numberPage']}</td>";
              echo "<td>{$book['Price']}</td>";
              echo "<td><form method='post'>";
              echo "<input type='hidden' value='{$book['id']}' name='id'/>";
              echo "<input type='submit' value='Delete' formaction='delete.php' class='btn btn-warnning'>";
              echo "</form></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-4 ms-5">
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <input type="text" id="bookName" name="name" placeholder="Name of the book" class="form-control input" />
          </div>
          <div class="mb-3">
            <input type="text" name="auther" placeholder="Author" class="form-control input" id="author" />
          </div>

          <div class="mb-3">
            <input type="number" name="number" placeholder="Number of pages" class="form-control input" id="pages" />
          </div>
          <div class="mb-3 mb-5">
            <input type="number" name="price" placeholder="Price in $" class="form-control input" id="price" />
          </div>
          <div class="d-flex justify-content-center">
            <input type="submit" id="add" class="btn btn-primary w-25 me-5" value="Add Book" />
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>