<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

//select data for log
$select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$user_id'");
$row = mysqli_fetch_array($select_user); 
//delete user and alumni
$delete_user = mysqli_query($conn, "DELETE FROM tbl_users WHERE user_id = '$user_id'");
$delete_alumni = mysqli_query($conn, "DELETE FROM tbl_alumni WHERE user_id = '$user_id'");

//insert to tbl_logs for changes
$action = "Delete User - ". $row['firstname'] .'' . $row['middlename'] . ' ' . $row['lastname'];
createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);

$_SESSION['deleted'] = true;
header("location: ../list.users.php");


?>