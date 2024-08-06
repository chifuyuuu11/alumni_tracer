<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$civil_id = $_GET['civil_id'];

if (isset($_POST['submit'])) {

    $civilstat = mysqli_real_escape_string($conn, $_POST['civil']);


    $select_civilstat = mysqli_query($conn, "SELECT * FROM tbl_cvlstat WHERE civilstat = '$civilstat'
    AND civil_id NOT IN ('$civil_id')");
    $check = mysqli_num_rows($select_civilstat);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_cvlstat SET civilstat = '$civilstat' WHERE civil_id = '$civil_id'");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Civil Status', '$civilstat', 'ctrl.edit.civil.stat.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.civil.stat.php?civil_id=". $civil_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.civil.stat.php?civil_id=". $civil_id);

    }
}

?>