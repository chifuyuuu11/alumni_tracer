<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

if (isset($_POST ['submit'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");

    $check = mysqli_num_rows($select_user);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_users
        (firstname, middlename, lastname, campus_id, role_id, contact, email, username, password)
        VALUES
        ('$firstname', '$middlename', '$lastname', '$campus', '$role', '$contact', '$email', '$username', '$hashed_pass')");

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Users', '$firstname $lastname', 'ctrl.add.users.php')");

        $_SESSION['success'] = true;
        header("location: ../add.users.php");

    } else {
        echo 1;
        $_SESSION['username_exist'] = true;
        header("location: ../add.users.php");

    }
}

?>