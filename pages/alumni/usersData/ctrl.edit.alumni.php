<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $attained = mysqli_real_escape_string($conn, $_POST['attained']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $aftergrad = mysqli_real_escape_string($conn, $_POST['aftergrad']);
    $work = mysqli_real_escape_string($conn, $_POST['work']);
    $current_work = mysqli_real_escape_string($conn, $_POST['current_work']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $company_address = mysqli_real_escape_string($conn, $_POST['company_address']);
    $scale = mysqli_real_escape_string($conn, $_POST['scale']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $suggestion = mysqli_real_escape_string($conn, $_POST['suggestion']);

    $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Alumni Info', '$fullname', 'ctrl.edit.alumni.php')");

   
    $insert_data = mysqli_query($conn, "UPDATE tbl_alumni SET attained_id = '$attained', program_id = '$program', batch = '$batch', aftergrad_id = '$aftergrad', work_id = '$work', current_work = '$current_work', company_name = '$company_name', company_address = '$company_address', scale = '$scale', experience = '$experience', suggestion = '$suggestion' WHERE user_id = '$user_id'");
    $_SESSION['alumni_info_updated'] = true;
    header("location: ../add.alumni.info?user_id=". $user_id);

    // $_SESSION['error_alumni_info_update'] = true;
    // header("location: ../add.alumni.info?user_id=". $user_id);

}

?>