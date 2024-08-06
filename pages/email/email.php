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





$mail->Subject ='Your Account Details Updated';
$mail->isHTML(true);
$mailContent = '<h1 style="color:red;">Hello Franciscan !</h1>
                    <p><strong>Dear Alumni</strong> <span style="color:black;">' . htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p>We are writing to inform you that the account details associated with your school account have been updated. This includes a change to your username and password.</p>
                    <p>If you did not request this change, please contact our school support team immediately to secure your account.</p>
                    <p>For your reference, your updated credentials are as follows:</p>

                    <p><strong>Username:</strong> <span style="color:#2e6da4;">' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p><strong>Password:</strong> <span style="color:#2e6da4;">' . htmlspecialchars($password, ENT_QUOTES, 'UTF-8') . '</span></p>
                     <p>To ensure the security of your account, please do not share your login credentials with anyone and consider changing your password regularly.</p>';

    $mail->Body = $mailContent;

$mail->send();
} catch(Exception $e){
    echo "HI PRETTY";
}


$_SESSION['email_update'] = true;
header("location: ../users/list.users.php");
 
?>

