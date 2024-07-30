<?php
require '../../includes/conn.php';
session_start();
$user_id = $_GET['user_id'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPmailer.php';
require '../PHPMailer/src/SMTP.php';

$info = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$user_id'"); 
$row = mysqli_fetch_array($info) ;
$email= $row['email'];


   
$mail = new PHPMailer(true);
try {

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth  = true;
$mail->SMTPSecure ='tls';
$mail->Host      = 'smtp.gmail.com';
$mail->Port      =587;
$mail->Username  = 'stfrancisbacoor.pass.reset@gmail.com';
$mail->Password  = 'islqiaavsjlrgoyf';
$mail->setFrom('sfacbacoor1981@gmail.com','SFAC-Bacoor');
$mail->addAddress($email);

$username =  $row['username'];
$password = $row['username'];
$firstname = $row['firstname'];





$mail->Subject ='Your Account Details';
$mail->isHTML(true);
$mail->Body ="<h1>Welcome Franciscans !</h1>
<p>Good Day $firstname,</p>
<p>Here are your account details:</p>
<p><strong>Username:</strong> $username</p>
<p><strong>Password:</strong> $password</p>
<p>Note :</p>
<p>Please keep this information secure and do not share it with anyone.</p>

";

$mail->send();
} catch(Exception $e){
    echo "HI PRETTY";
}


$_SESSION['email'] = true;
header("location: ../users/list.users.php");
 
?>

