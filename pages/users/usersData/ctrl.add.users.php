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

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email = '$email'");
    $check = mysqli_num_rows($select_user);

    $select_user1 = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");
    $check2 = mysqli_num_rows($select_user1);

    if ($check == 0 && $check2 == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "INSERT INTO tbl_users
        (firstname, middlename, lastname, campus_id, role_id, contact, email, username, password)
        VALUES
        ('$firstname', '$middlename', '$lastname', '$campus', '$role', '$contact', '$email', '$username', '$hashed_pass')");

        if ($role == 1) {
            $select_user = mysqli_query($conn, "SELECT user_id FROM tbl_users ORDER BY user_id DESC LIMIT 1");
            $id = mysqli_fetch_array($select_user);

            $insert_alumni = mysqli_query($conn, "INSERT INTO tbl_alumni (user_id) VALUES        ('$id[user_id]')");

        } elseif ($role == 2) {
            $select_user = mysqli_query($conn, "SELECT user_id FROM tbl_users ORDER BY user_id DESC LIMIT 1");
            $id = mysqli_fetch_array($select_user);

            $insert_student = mysqli_query($conn, "INSERT INTO tbl_students (user_id) VALUES        ('$id[user_id]')");

        }

        $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Add Users', '$firstname $lastname', 'ctrl.add.users.php')");

        $_SESSION['success'] = true;
        header("location: ../add.users.php");

    } else {
        if ($check != 0 && $check2 != 0) {
            $_SESSION['username&email_exist'] = true;
        } else if  ($check != 0) {
            $_SESSION['email_exist'] = true;
        } else if ($check2 != 0) {
            $_SESSION['username_exist'] = true;
     
        }

        header("location: ../add.users.php");

    }
}

?>