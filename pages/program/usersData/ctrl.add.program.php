<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $program = mysqli_real_escape_string($conn, $_POST['program']);

    $select_program = mysqli_query($conn, "SELECT * FROM tbl_program WHERE program = '$program'");

    $check = mysqli_num_rows($select_program);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_program (program) VALUES ('$program')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Program', '$program', 'ctrl.add.program.php')");
        
        $_SESSION['program'] = true;
        header("location: ../add.program.php");

    } else {
        echo 1;
        $_SESSION['program_exist'] = true;
        header("location: ../add.program.php");

    }
}

?>