<?php
require '../../../includes/conn.php';
session_start();
ob_start();

if (isset($_GET['dept_id'])) {

    $dept_id = mysqli_real_escape_string($conn, $_GET['dept_id']);

    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE dept_id = '$dept_id' ORDER BY program_desc");
    $array = [];

    while ($row = mysqli_fetch_array($select_program)) {

        $array[] = $row;

    }

    echo json_encode($array);

} elseif (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    $select_email = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email = '$email'");
    $result = mysqli_num_rows($select_email);

    echo $result;
    
}



?>