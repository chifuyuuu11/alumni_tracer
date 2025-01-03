<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$school_id = $_GET['school_id'];

$select_user = mysqli_query($conn, "SELECT * FROM tbl_schools WHERE school_id = '$school_id'");
$row = mysqli_fetch_array($select_user);
$school = $row['school'];

$delete_school = mysqli_query($conn, "DELETE FROM tbl_schools WHERE school_id = '$school_id'");

$action = "Deleted School, $school";
createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);

$_SESSION['deleted'] = true;
header("location: ../list.school.php");


?>