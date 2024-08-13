<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$level_id = $_GET['level_id'];

if (isset($_POST['submit'])) {

    $level = mysqli_real_escape_string($conn, $_POST['level']);


    $select_level = mysqli_query($conn, "SELECT * FROM tbl_levels WHERE level = '$level'
    AND level_id NOT IN ('$level_id')");
    $check = mysqli_num_rows($select_level);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_levels SET level = '$level' WHERE level_id = '$level_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Grade Level Attained', '$level', 'ctrl.edit.level.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.level.php?level_id=". $level_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.level.php?level_id=". $level_id);

    }
}

?>