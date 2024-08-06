<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$campus_id = $_GET['campus_id'];

if (isset($_POST['submit'])) {

    $campus = mysqli_real_escape_string($conn, $_POST['campus']);


    $select_campus = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE campus = '$campus'
    AND campus_id NOT IN ('$campus_id')");
    $check = mysqli_num_rows($select_campus);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_campus SET campus = '$campus' WHERE campus_id = '$campus_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Campus', '$campus', 'ctrl.edit.campus.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.campus.php?campus_id=". $campus_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.campus.php?campus_id=". $campus_id);

    }
}

?>