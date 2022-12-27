<?php

require_once("Class.Database.php");

session_start();
session_unset();
session_destroy();

header('location:loginPage.php');
