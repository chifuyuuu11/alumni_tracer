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
    $estatus = mysqli_real_escape_string($conn, $_POST['estatus']);
    $alligned = mysqli_real_escape_string($conn, $_POST['alligned']);

    $insert_data = mysqli_query($conn, "UPDATE tbl_alumni SET estatus_id = '$estatus', attained_id = '$attained', program_id = '$program', batch = '$batch', alligned = '$alligned', aftergrad_id = '$aftergrad', work_id = '$work', current_work = '$current_work', company_name = '$company_name', company_address = '$company_address', scale = '$scale', experience = '$experience', suggestion = '$suggestion' WHERE user_id = '$user_id'");
    
    //insert to tbl_logs for changes
    $action = "Updated Alumni, $firstname $middlename $lastname";
    createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);
    
    $_SESSION['alumni_info_updated'] = true;
    header("location: ../add.alumni.info?user_id=". $user_id);

    // $_SESSION['error_alumni_info_update'] = true;
    // header("location: ../add.alumni.info?user_id=". $user_id);

}

?>