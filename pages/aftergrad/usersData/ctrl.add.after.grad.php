<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $aftergrad = mysqli_real_escape_string($conn, $_POST['aftergrad']);

    $select_aftergrad = mysqli_query($conn, "SELECT * FROM tbl_aftergrad WHERE aftergrad = '$aftergrad'");

    $check = mysqli_num_rows($select_aftergrad);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_aftergrad (aftergrad) VALUES ('$aftergrad')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add After Graduation', '$aftergrad', 'ctrl.add.after.grad.php')");
        
        $_SESSION['aftergrad'] = true;
        header("location: ../add.after.grad.php");

    } else {
        echo 1;
        $_SESSION['aftergrad_exist'] = true;
        header("location: ../add.after.grad.php");

    }
}

?>