<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $department = mysqli_real_escape_string($conn, $_POST['department']);

    $select_department = mysqli_query($conn, "SELECT * FROM tbl_department WHERE department = '$department'");

    $check = mysqli_num_rows($select_department);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_department (department) VALUES ('$department')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add department', '$department', 'ctrl.department.php')");
        
        $_SESSION['department'] = true;
        header("location: ../add.department.php");

    } else {
        
        $_SESSION['department_exist'] = true;
        header("location: ../add.department.php");

    }
}

?>