<?php

require_once("Class.Database.php");
$id = $_POST['sid'];
Database::connect()->query("DELETE FROM users WHERE id='$id'");
header('location:AdminPage.php');
