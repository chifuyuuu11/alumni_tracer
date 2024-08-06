<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$work_id = $_GET['work_id'];

$select_work = mysqli_query($conn, "SELECT * FROM tbl_work WHERE work_id = '$work_id'");
$row = mysqli_fetch_array($select_work);
$work = $row['work'];
$delete_work = mysqli_query($conn, "DELETE FROM tbl_work WHERE work_id = '$work_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[work]', '$_SESSION[user_role]', 'Delete Work', '$work', 'ctrl.delete.work.php')");

$_SESSION['deleted'] = true;
header("location: ../list.work.php");


?>