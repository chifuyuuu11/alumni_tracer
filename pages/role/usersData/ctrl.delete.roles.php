<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$role_id = $_GET['role_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_roles WHERE role_id = '$role_id'");
$row = mysqli_fetch_array($select_user);
$role = $row['role'];
$delete_role = mysqli_query($conn, "DELETE FROM tbl_roles WHERE role_id = '$role_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Roles', '$role', 'ctrl.delete.roles.php')");

$_SESSION['deleted'] = true;
header("location: ../list.roles.php");


?>