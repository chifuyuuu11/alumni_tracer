<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $level = mysqli_real_escape_string($conn, $_POST['level']);

    $select_level = mysqli_query($conn, "SELECT * FROM tbl_levels WHERE level = '$level'");

    $check = mysqli_num_rows($select_level);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_levels (level) VALUES ('$level')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Grade Level Attained', '$level', 'ctrl.add.level.php')");
        
        $_SESSION['level'] = true;
        header("location: ../add.level.php");

    } else {
        echo 1;
        $_SESSION['level_exist'] = true;
        header("location: ../add.level.php");

    }
}

?>