<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$user_id = $_GET['user_id'];

if (isset($_POST['upload'])){

    if (empty($_FILES['img']['tmp_name'])) {
        header('location: ../edit.user.php?user_id=' . $user_id);
    } else {
        $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));
        $_SESSION['img'] = true;
        $insert_data = mysqli_query($conn, "UPDATE tbl_users SET img = '$img' WHERE user_id = '$user_id'");
        header("location: ../edit.users.php?user_id=". $user_id);
    }

} elseif (isset($_POST['update'])) {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $civilstat = mysqli_real_escape_string($conn, $_POST['civilstat']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email = '$email'
    AND user_id NOT IN ('$user_id')");
    $check = mysqli_num_rows($select_user);
    
    if ($check == 0) {
    $insert_data = mysqli_query($conn, "UPDATE tbl_users SET firstname = '$firstname', middlename = '$middlename',
        lastname = '$lastname', role_id = '$role', campus_id = '$campus', gender_id = '$gender', civil_id = '$civilstat', 
        birthdate = '$birthdate', address = '$address', email = '$email', contact = '$contact' WHERE user_id = '$user_id'");
        $_SESSION['updated'] = true;
        header("location: ../edit.users.php?user_id=". $user_id);
    } else {
        $_SESSION['error_edit'] = true;
        header("location: ../edit.users.php?user_id=". $user_id);
    }

} elseif (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'
    AND user_id NOT IN ('$user_id')");
    $check = mysqli_num_rows($select_user);

    if ($check == 0) {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $insert_data = mysqli_query($conn, "UPDATE tbl_users SET username = '$username', password = '$hashed_pass' WHERE user_id = '$user_id'");
        $_SESSION['updated'] = true;
        header("location: ../edit.users.php?user_id=". $user_id);

    } else {
        $_SESSION['error_update'] = true;
        header("location: ../edit.users.php?user_id=". $user_id);

    }
}

?>