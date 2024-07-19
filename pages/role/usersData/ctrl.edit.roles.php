<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$role_id = $_GET['role_id'];

if (isset($_POST['submit'])) {

    $role = mysqli_real_escape_string($conn, $_POST['role']);


    $select_role = mysqli_query($conn, "SELECT * FROM tbl_roles WHERE role = '$role'
    AND role_id NOT IN ('$role_id')");
    $check = mysqli_num_rows($select_role);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_roles SET role = '$role' WHERE role_id = '$role_id'");
        $_SESSION['updated'] = true;
        header("location: ../edit.roles.php?role_id=". $role_id);

    } else {
        echo 1;
        $_SESSION['role_exist'] = true;
        header("location: ../edit.roles.php?role_id=". $role_id);

    }
}

?>