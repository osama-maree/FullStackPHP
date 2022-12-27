<?php
session_start();


require_once("Class.Database.php");
$id = $_SESSION['id'];

Database::connect()->query("DELETE FROM users WHERE id='$id'");
Database::disconnect();
session_start();
session_unset();
session_destroy();

header('location:loginPage.php');
