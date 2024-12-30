<?php
ob_start();
session_start();
if (!isset($_SESSION['user_role'])) {
    header("location: ../login/login.php");
}

//logs
function createlogs($conn, $user_id, $action, $role) {
    mysqli_query($conn, "INSERT INTO tbl_logs (user_id, action, role, updated_at) VALUES ('$user_id', '$action', '$role', CURRENT_TIMESTAMP())");
}

error_reporting(E_ALL ^ E_DEPRECATED);
?>