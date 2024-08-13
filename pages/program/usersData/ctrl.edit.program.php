<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$program_id = $_GET['program_id']; 

if (isset($_POST['submit'])) {

    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $program_abv = mysqli_real_escape_string($conn, $_POST['program_abv']);
    $program_desc = mysqli_real_escape_string($conn, $_POST['program_desc']);

    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE program_abv = '$program_abv' || program_desc = '$program_desc'
    AND program_id NOT IN ('$program_id')");
    $check = mysqli_num_rows($select_program);

    if ($check == 0) {

        $insert_data = mysqli_query($conn, "UPDATE tbl_programs SET dept_id = '$department', program_abv = '$program_abv',
        program_desc = '$program_desc' WHERE program_id = '$program_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Program', '$program', 'ctrl.edit.program.php')");

        $_SESSION['updated'] = true;
        header("location: ../list.program.php?program_id=" . $program_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.program.php?program_id=" . $program_id);

    }
}

?>