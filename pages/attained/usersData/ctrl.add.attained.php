<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $attained = mysqli_real_escape_string($conn, $_POST['attained']);

    $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE attained = '$attained'");

    $check = mysqli_num_rows($select_attained);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_attained (attained) VALUES ('$attained')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Grade Level Attained', '$attained', 'ctrl.add.attained.php')");
        
        $_SESSION['attained'] = true;
        header("location: ../add.attained.php");

    } else {
        echo 1;
        $_SESSION['attained_exist'] = true;
        header("location: ../add.attained.php");

    }
}

?>