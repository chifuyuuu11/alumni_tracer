<?php
require '../../../includes/conn.php';
require '../../../includes/session.php';

$school_id = $_GET['school_id'];

if(isset($_POST['submit'])) {
  $school = mysqli_real_escape_string($conn, $_POST['school']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);

  $select_school = mysqli_query($conn, "SELECT school FROM tbl_schools WHERE school = '$school' AND school_id NOT IN ('$school_id')");
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
  
    $insert_school = mysqli_query($conn, "UPDATE tbl_schools SET school = '$school', dept_id = '$department', program_id = '$program' WHERE school_id = '$school_id'");
    $action = "Updated School, $school";
    createlogs($conn, $_SESSION['user_id'], $action, $_SESSION['user_role']);

    $_SESSION['updated'] = true;
    header('location: ../edit.school.php?school_id='.$school_id);

  } else {
    $_SESSION['school_exist'] = true;
    header('location: ../edit.school.php?school_id='.$school_id);

  }
  
  
  
}



?>