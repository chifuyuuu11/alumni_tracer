<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $campus = mysqli_real_escape_string($conn, $_POST['campus']);

    $select_campus = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE campus = '$campus'");

    $check = mysqli_num_rows($select_campus);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_campus (campus) VALUES ('$campus')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Campus', '$campus', 'ctrl.add.campus.php')");
        
        $_SESSION['campus'] = true;
        header("location: ../add.campus.php");

    } else {
        echo 1;
        $_SESSION['campus_exist'] = true;
        header("location: ../add.campus.php");

    }
}

?>