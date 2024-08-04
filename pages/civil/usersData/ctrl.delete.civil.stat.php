<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$civil_id = $_GET['civil_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_cvlstat WHERE civil_id = '$civil_id'");
$row = mysqli_fetch_array($select_user);
$civilstat = $row['civilstat'];
$delete_civilstat = mysqli_query($conn, "DELETE FROM tbl_cvlstat WHERE civil_id = '$civil_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Civil Status', '$civilstat', 'ctrl.delete.civil.stat.php')");

$_SESSION['deleted'] = true;
header("location: ../list.civil.stat.php");


?>