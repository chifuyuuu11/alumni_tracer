<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$reg_id = $_GET['reg_id'];

$select_reg = mysqli_query($conn, "SELECT * FROM tbl_registrations WHERE reg_id = '$reg_id'");
$row = mysqli_fetch_array($select_reg); 
$fullname = $row['firstname'] . ' ' . $row['lastname'];

$delete_reg = mysqli_query($conn, "DELETE FROM tbl_registrations WHERE reg_id = '$reg_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link, updated_at) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Registration', '$fullname', 'ctrl.delete.registration.php', 'CURRENT_TIMESTAMP')");

$_SESSION['deleted'] = true;
header("location: ../list.registration.php");


?>