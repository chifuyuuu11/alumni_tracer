<?php
ob_start();
session_start();

if (isset($_SESSION['user_id'])) {

} else {
    header("Location: ../login/login.php");
}
?>