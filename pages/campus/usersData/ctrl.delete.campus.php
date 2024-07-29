<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$campus_id = $_GET['campus_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE campus_id = '$campus_id'");
$row = mysqli_fetch_array($select_user);
$campus = $row['campus'];
$delete_campus = mysqli_query($conn, "DELETE FROM tbl_campus WHERE campus_id = '$campus_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Campus', '$campus', 'ctrl.delete.campus.php')");

$_SESSION['deleted'] = true;
header("location: ../list.campus.php");


?>