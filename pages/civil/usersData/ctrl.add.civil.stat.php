<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $civilstat = mysqli_real_escape_string($conn, $_POST['civil']);

    $select_civilstat = mysqli_query($conn, "SELECT * FROM tbl_cvlstat WHERE civilstat = '$civilstat'");

    $check = mysqli_num_rows($select_civilstat);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_cvlstat (civilstat) VALUES ('$civilstat')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Civil Status', '$civilstat', 'ctrl.add.civil.stat.php')");
        
        $_SESSION['civilstat'] = true;
        header("location: ../add.civil.stat.php");

    } else {
        echo 1;
        $_SESSION['civilstat_exist'] = true;
        header("location: ../add.civil.stat.php");

    }
}

?>