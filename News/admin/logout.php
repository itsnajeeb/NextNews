<?php
include_once('config.php');

session_start();

session_unset();

session_destroy();
header("Location:".$hostname."/admin/index.php");
// http://localhost/New_Project/admin/index.php
?>
