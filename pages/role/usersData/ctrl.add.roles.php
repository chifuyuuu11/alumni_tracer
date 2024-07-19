<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST['submit'])) {

    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_roles WHERE role = '$role'");

    $check = mysqli_num_rows($select_user);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_roles (role) VALUES ('$role')");

        $_SESSION['role'] = true;
        header("location: ../add.roles.php");

    } else {
        echo 1;
        $_SESSION['role_exist'] = true;
        header("location: ../add.roles.php");

    }
}

?>