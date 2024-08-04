<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $work = mysqli_real_escape_string($conn, $_POST['work']);

    $select_work = mysqli_query($conn, "SELECT * FROM tbl_work WHERE work = '$work'");

    $check = mysqli_num_rows($select_work);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_work (work) VALUES ('$work')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Work', '$work', 'ctrl.add.work.php')");
        
        $_SESSION['work'] = true;
        header("location: ../add.work.php");

    } else {
        echo 1;
        $_SESSION['work_exist'] = true;
        header("location: ../add.work.php");

    }
}

?>