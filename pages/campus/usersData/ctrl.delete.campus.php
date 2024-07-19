<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$campus_id = $_GET['campus_id'];

$delete_campus = mysqli_query($conn, "DELETE FROM tbl_campus WHERE campus_id = '$campus_id'");
$_SESSION['deleted'] = true;
header("location: ../list.campus.php");


?>