<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$program_id = $_GET['program_id'];

$select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE program_id = '$program_id'");
$row = mysqli_fetch_array($select_program);
$delete_program = mysqli_query($conn, "DELETE FROM tbl_programs WHERE program_id = '$program_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Program', '$program', 'ctrl.delete.program.php')");

$_SESSION['deleted'] = true;
header("location: ../list.program.php");


?>