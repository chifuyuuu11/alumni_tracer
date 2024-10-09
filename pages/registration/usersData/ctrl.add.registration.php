<?php
session_start();
require '../../../includes/conn.php';


if(isset($_POST['submit'])) {
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $program = mysqli_real_escape_string($conn, $_POST['program']);
  $attained = mysqli_real_escape_string($conn, $_POST['attained']);
  $batch = mysqli_real_escape_string($conn, $_POST['batch']);


  $insert_reg = mysqli_query($conn, "INSERT INTO tbl_registrations (firstname, middlename, lastname, email, contact_no, role_id, level_id, dept_id, batch, status)
  VALUES ('$firstname', '$middlename', '$lastname', '$email', '$contact_no', 3, '$attained', '$program','$batch', 'Pending')");
  
  $_SESSION['success_register'] = true;
  header('location: ../add.registration.php');
  
}

?>