<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$aftergrad_id = $_GET['aftergrad_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_aftergrad WHERE aftergrad_id = '$aftergrad_id'");
$row = mysqli_fetch_array($select_user);
$aftergrad = $row['aftergrad'];
$delete_aftergrad = mysqli_query($conn, "DELETE FROM tbl_aftergrad WHERE aftergrad_id = '$aftergrad_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete After Graduation', '$aftergrad', 'ctrl.delete.after.grad.php')");

$_SESSION['deleted'] = true;
header("location: ../list.after.grad.php");


?>