<?php
session_start();
require '../../../includes/conn.php';


if(isset($_POST['submit'])) {
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);

  $insert_reg = mysqli_query($conn, "INSERT INTO tbl_registrations (firstname, middlename, lastname, email, contact_no, role_id, gender_id, status)
  VALUES ('$firstname', '$middlename', '$lastname', '$email', '$contact_no', '$role', '$gender','Pending')");
  
  $_SESSION['success_register'] = true;
  header('location: ../add.registration.php');
  
}

?>