<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$user_id'");
$row = mysqli_fetch_array($select_user); 
$fullname = $row['firstname'] . ' ' . $row['lastname'];

$delete_user = mysqli_query($conn, "DELETE FROM tbl_users WHERE user_id = '$user_id'");
$delete_alumni = mysqli_query($conn, "DELETE FROM tbl_alumni WHERE user_id = '$user_id'");
$delete_students = mysqli_query($conn, "DELETE FROM tbl_students WHERE user_id = '$user_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Users', '$fullname', 'ctrl.delete.users.php')");

$_SESSION['deleted'] = true;
header("location: ../list.users.php");


?>