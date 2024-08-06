<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $student = mysqli_real_escape_string($conn, $_POST['student']);
    $attained_id = mysqli_real_escape_string($conn, $_POST['attained_id']);


        $insert_data = mysqli_query($conn, "UPDATE tbl_student SET student = '$student', batch = '$batch', program_id = '$program_id', attained_id ='$attained_id'
        WHERE user_id = '$user_id'");
        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link)VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Student Info', '$fullname', 'ctrl.edit.student.info.php')");

        $_SESSION['updated'] = true;
        header("location: ../add.student.info.php?user_id=". $user_id);

}

?>