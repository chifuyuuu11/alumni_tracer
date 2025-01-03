<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);

    $update_pc = mysqli_query($conn, "UPDATE tbl_program_chairperson SET school_id = '$school' WHERE user_id = '$user_id'");

    //insert to tbl_logs for changes
    $action = "Updated Program Chairperson, $fullname";
    createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);
    
    $_SESSION['alumni_info_updated'] = true;
    header("location: ../add.program.chairperson.info.php?user_id=". $user_id);


}


?>