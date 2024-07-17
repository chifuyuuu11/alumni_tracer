<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

$delete_user = mysqli_query($conn, "DELETE FROM tbl_users WHERE user_id = '$user_id'");
$_SESSION['deleted'] = true;
header("location: ../list.users.php");


?>