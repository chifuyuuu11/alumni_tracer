<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$role_id = $_GET['role_id'];

$delete_role = mysqli_query($conn, "DELETE FROM tbl_roles WHERE role_id = '$role_id'");
$_SESSION['deleted'] = true;
header("location: ../list.roles.php");


?>