<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';


if(isset($_POST['submit'])) {
  $school = mysqli_real_escape_string($conn, $_POST['school']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);

  $select_school = mysqli_query($conn, "SELECT school FROM tbl_schools WHERE school = '$school'");
  $result = mysqli_num_rows($select_school);

  if ($result == 0) {
    if (isset($_POST['program'])) {
      foreach ($_POST['program'] as $i) {
        $program[] = mysqli_real_escape_string($conn, $i);
      }
    
      $program = implode(', ', $program);
    } else {
      $program = "";
    }
  
    $insert_school = mysqli_query($conn, "INSERT INTO tbl_schools (school, dept_id, program_id) VALUES ('$school', '$department', '$program')");
    $action = "Added School, $school";
    createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);

    $_SESSION['success'] = true;
    header('location: ../add.school.php');

  } else {
    $_SESSION['school_exist'] = true;
    header('location: ../add.school.php');

  }
  
  
  
}



?>