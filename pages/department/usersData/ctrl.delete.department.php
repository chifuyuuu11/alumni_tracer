<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$dept_id = $_GET['dept_id'];

$select_dept = mysqli_query($conn, "SELECT * FROM tbl_department WHERE dept_id = '$dept_id'");
$row = mysqli_fetch_array($select_dept);
$department = $row['department'];
$delete_dept = mysqli_query($conn, "DELETE FROM tbl_department WHERE dept_id = '$dept_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Department', '$department', 'ctrl.delete.department.php')");

$_SESSION['deleted'] = true;
header("location: ../list.department.php");


?>