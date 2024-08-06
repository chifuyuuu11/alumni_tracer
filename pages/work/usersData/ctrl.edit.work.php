<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$work_id = $_GET['work_id'];

if (isset($_POST['submit'])) {

    $work = mysqli_real_escape_string($conn, $_POST['work']);


    $select_work = mysqli_query($conn, "SELECT * FROM tbl_work WHERE work = '$work'
    AND work_id NOT IN ('$work_id')");
    $check = mysqli_num_rows($select_work);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_work SET work = '$work' WHERE work_id = '$work_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Work', '$campus', 'ctrl.edit.work.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.work.php?work_id=". $work_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.work.php?work_id=". $work_id);

    }
}

?>