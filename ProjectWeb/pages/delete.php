<?php

require_once("Class.Database.php");
$id = $_POST['id'];
$conn = Database::connect();
$conn->query("DELETE FROM books WHERE id='$id'");

header('location:AdminPage.php');
