<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$dept_id = $_GET['dept_id'];

if (isset($_POST['submit'])) {

    $department = mysqli_real_escape_string($conn, $_POST['department']);


    $select_department = mysqli_query($conn, "SELECT * FROM tbl_department WHERE department = '$department'
    AND dept_id NOT IN ('$dept_id')");
    $check = mysqli_num_rows($select_department);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_department SET department = '$department' WHERE dept_id = '$dept_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Department', '$department', 'ctrl.edit.department.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.department.php?dept_id=". $dept_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.department.php?dept_id=". $dept_id);

    }
}

?>