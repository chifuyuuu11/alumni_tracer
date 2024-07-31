<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$attained_id = $_GET['attained_id'];

if (isset($_POST['submit'])) {

    $attained = mysqli_real_escape_string($conn, $_POST['attained']);


    $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE attained = '$attained'
    AND attained_id NOT IN ('$attained_id')");
    $check = mysqli_num_rows($select_attained);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_attained SET attained = '$attained' WHERE attained_id = '$attained_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Grade Level Attained', '$attained', 'ctrl.edit.attained.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.attained.php?attained_id=". $attained_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.attained.php?attained_id=". $attained_id);

    }
}

?>