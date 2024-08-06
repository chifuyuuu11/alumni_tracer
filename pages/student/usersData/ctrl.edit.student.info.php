<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $attained_id = mysqli_real_escape_string($conn, $_POST['attained_id']);
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $student_no = mysqli_real_escape_string($conn, $_POST['student_no']);

    $insert_data = mysqli_query($conn, "UPDATE tbl_students SET attained_id = '$attained_id', program_id = '$program_id', batch = '$batch', student_no = '$student_no' 
        WHERE user_id = '$user_id'");

    $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Student Info', '$fullname', 'ctrl.edit.student.info.php')");

    $_SESSION['updated'] = true;
    header("location: ../add.student.info.php?user_id=". $user_id);


}

?>