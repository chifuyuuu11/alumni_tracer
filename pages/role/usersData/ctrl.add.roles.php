<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST['submit'])) {

    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $select_role = mysqli_query($conn, "SELECT * FROM tbl_roles WHERE role = '$role'");

    $check = mysqli_num_rows($select_role);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_roles (role) VALUES ('$role')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Role', '$role', 'ctrl.add.roles.php')");

        $_SESSION['role'] = true;
        header("location: ../add.roles.php");

    } else {
        echo 1;
        $_SESSION['role_exist'] = true;
        header("location: ../add.roles.php");

    }
}

?>