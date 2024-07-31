<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

if (isset($_POST['submit'])) {

    $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'
    AND user_id NOT IN ('$user_id')");
    $check = mysqli_num_rows($select_user);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_users SET img = '$img', firstname = '$firstname', middlename = '$middlename',
        lastname = '$lastname', role_id = '$role', campus_id='$campus', email = '$email', contact = '$contact',
        username = '$username', password = '$hashed_pass' WHERE user_id = '$user_id'");

$insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Edit Users', '$firstname $lastname', 'ctrl.edit.users.php')");

        $_SESSION['updated'] = true;
        header("location: ../edit.users.php?user_id=". $user_id);

    } else {
        echo 1;
        $_SESSION['error_update'] = true;
        header("location: ../edit.users.php?user_id=". $user_id);

    }
}

?>