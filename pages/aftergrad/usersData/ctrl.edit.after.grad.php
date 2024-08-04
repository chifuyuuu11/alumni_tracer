<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$aftergrad_id = $_GET['aftergrad_id'];

if (isset($_POST['submit'])) {

    $aftergrad = mysqli_real_escape_string($conn, $_POST['aftergrad']);


    $select_aftergrad = mysqli_query($conn, "SELECT * FROM tbl_aftergrad WHERE aftergrad = '$aftergrad'
    AND aftergrad_id NOT IN ('$aftergrad_id')");
    $check = mysqli_num_rows($select_aftergrad);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_aftergrad SET aftergrad = '$aftergrad' WHERE aftergrad_id = '$aftergrad_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit After Graduation', '$aftergrad', 'ctrl.edit.after.grad.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.after.grad.php?aftergrad_id=". $aftergrad_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.after.grad.php?aftergrad_id=". $aftergrad_id);

    }
}

?>