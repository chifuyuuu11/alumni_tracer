<?php
ob_start();
session_start();
if (!isset($_SESSION['user_role'])) {
    header("location: ../login/login.php");
}

error_reporting(E_ALL ^ E_DEPRECATED);
?>