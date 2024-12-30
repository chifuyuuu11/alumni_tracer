<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$reg_id = $_GET['reg_id'];

//select data for log
$select_reg = mysqli_query($conn, "SELECT * FROM tbl_registrations WHERE reg_id = '$reg_id'");
$row = mysqli_fetch_array($select_reg); 
//delete
$delete_reg = mysqli_query($conn, "DELETE FROM tbl_registrations WHERE reg_id = '$reg_id'");


$action = "Delete Registration - " . $row['firstname'] ." ". $row['middlename'] ." ". $row['lastname'];
createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);

$_SESSION['deleted'] = true;
header("location: ../list.registration.php");


?>