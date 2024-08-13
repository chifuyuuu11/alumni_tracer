<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $program_abv = mysqli_real_escape_string($conn, $_POST['program_abv']);
    $program_desc = mysqli_real_escape_string($conn, $_POST['program_desc']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE program_abv = '$program_abv'");

    $check = mysqli_num_rows($select_program);

    if ($check == 0) {
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_programs (program_abv, program_desc, dept_id) VALUES ('$program_abv', '$program_desc', '$department')");
        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Program', '$program_abv', 'ctrl.add.program.php')");
        
        $_SESSION['program'] = true;
        header("location: ../list.program.php");

    } else {
        echo 1;
        $_SESSION['program_exist'] = true;
        header("location: ../add.program.php");

    }
}

?>