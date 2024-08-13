<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$level_id = $_GET['level_id'];

$select_level = mysqli_query($conn, "SELECT * FROM tbl_levels WHERE level_id = '$level_id'");
$row = mysqli_fetch_array($select_level);
$level = $row['level'];
$delete_level = mysqli_query($conn, "DELETE FROM tbl_levels WHERE level_id = '$level_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Grade Level level', '$level', 'ctrl.delete.level.php')");

$_SESSION['deleted'] = true;
header("location: ../list.level.php");


?>