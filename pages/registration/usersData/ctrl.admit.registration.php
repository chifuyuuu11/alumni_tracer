<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

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
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    

  $select_username = mysqli_query($conn, "SELECT username FROM tbl_users WHERE username = '$username'");
  $result_username = mysqli_num_rows($select_username);

  $select_email = mysqli_query($conn, "SELECT email FROM tbl_users WHERE email = '$email'");
  $result_email = mysqli_num_rows($select_email);
  
  if ($result_email == 0 && $result_username == 0) {
    //password hash
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    //insert to tbl_users
    $insert_user = mysqli_query($conn, "INSERT INTO tbl_users
    (firstname, middlename, lastname, role_id, campus_id, contact, email, username, password )
    VALUES
    ('$firstname', '$middlename', '$lastname', 1, '$campus', '$contact', '$email', '$username', '$hashed_pass')");

    //get id 
    $select_user = mysqli_query($conn, "SELECT user_id FROM tbl_users ORDER BY user_id DESC LIMIT 1");
    $id = mysqli_fetch_array($select_user);

    //insert to tbl_alumni
    $insert_alumni = mysqli_query($conn, "INSERT INTO tbl_alumni (user_id, program_id, attained_id, batch) VALUES ('$id[user_id]', '$program', '$attained', '$batch')");

    //update status for reg
    $update_query = mysqli_query($conn, "UPDATE tbl_registrations SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', email = '$email', contact_no = '$contact', status = 'Approved', campus_id = '$campus' WHERE reg_id = '$reg_id'");

    //insert to tbl_logs for changes
    $action = "Admitted Registration, $firstname $middlename $lastname";
    createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);

    $_SESSION['success_admit'] = true;
    header("location: ../../email/approved.user.acc.php?user_id=". $id['user_id'] . "&username=". $username ."&password=". $password);

} else {
    //clown
    if ($result_email > 0 && $result_username > 0) {
      $_SESSION['username&email_exist'] = true;

    } elseif ( $result_username > 0) {
      $_SESSION['username_exist'] = true;

    } else {
      $_SESSION['email_exist'] = true;

    }
    
    header("location: ../admit.registration.php?reg_id=". $reg_id);
    
}
  
}

?>