<?php
session_start();
require '../../../includes/conn.php'; 

$reg_id = $_GET['reg_id'];

if(isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $attained = mysqli_real_escape_string($conn, $_POST['attained']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    

  $select_user = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$username'");

  $check = mysqli_num_rows($select_user);

  if ($check == 0 ) {
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $insert_reg = mysqli_query($conn, "INSERT INTO tbl_users
    (firstname, middlename, lastname, role_id, contact, email, username, password, attained_id, program_id, batch )
    VALUES
    ('$firstname', '$middlename', '$lastname', 1, '$contact', '$email', '$username', '$hashed_pass', '$attained', '$program','$batch' )");

    $update_query = mysqli_query($conn, "UPDATE tbl_registrations SET status = 'Approved' WHERE reg_id = '$reg_id'");

    $insert_log = mysqli_query($conn, "INSERT INTO tbl_logs (username, role, action, sp_action, link) VALUES ('$_SESSION[username]', '$_SESSION[user_role]', 'Admit Users', '$firstname $lastname', 'ctrl.admit.registration.php')");


    $select_user = mysqli_query($conn, "SELECT user_id FROM tbl_users ORDER BY user_id DESC LIMIT 1");
    $id = mysqli_fetch_array($select_user);

    $insert_alumni = mysqli_query($conn, "INSERT INTO tbl_alumni (user_id) VALUES        ('$id[user_id]')");
    $_SESSION['success_admit'] = true;
    header("location: ../../email/approved.user.acc.php?reg_id=". $reg_id."&username=". $username);

    


    

} else {
    echo 1;
    $_SESSION['username_exist'] = true;
    header("location: ../list.registration.php?reg_id=". $reg_id);
}
  
}

?>