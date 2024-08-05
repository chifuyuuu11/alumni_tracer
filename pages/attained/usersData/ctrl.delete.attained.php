<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$attained_id = $_GET['attained_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE attained_id = '$attained_id'");
$row = mysqli_fetch_array($select_user);
$attained = $row['attained'];
$delete_attained = mysqli_query($conn, "DELETE FROM tbl_attained WHERE attained_id = '$attained_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Delete Grade Level Attained', '$attained', 'ctrl.delete.attained.php')");

$_SESSION['deleted'] = true;
header("location: ../list.attained.php");


?>