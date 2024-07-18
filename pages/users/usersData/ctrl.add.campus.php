<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $campus = mysqli_real_escape_string($conn, $_POST['campus']);

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE campus = '$campus'");

    $check = mysqli_num_rows($select_user);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_campus (campus) VALUES ('$campus')");
        
        $_SESSION['campus'] = true;
        header("location: ../../campus/add.campus.php");

    } else {
        echo 1;
        $_SESSION['campus_exist'] = true;
        header("location: ../../campus/add.campus.php");

    }
}

?>