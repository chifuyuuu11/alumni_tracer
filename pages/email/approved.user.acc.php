<?php
require '../../includes/conn.php';
session_start();
$reg_id = $_GET['reg_id'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPmailer.php';
require '../PHPMailer/src/SMTP.php';

$info = mysqli_query($conn, "SELECT * FROM tbl_registrations WHERE reg_id = '$reg_id'"); 
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

$username =  $_GET['username'];
$password = $_GET['username'];
$firstname = $row['firstname'];





$mail->Subject ='Your Account have been Approved';
$mail->isHTML(true);
$mailContent = '<h1 style="color:red;">Welcome Franciscan !</h1>
                    <p><strong>Dear</strong> <span style="color:black;">' . htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p> We are pleased to inform you that your account on the Alumni System has been approved. You can now access the system using the login details provided below:</p>
                    <p>For your reference, your credentials are as follows:</p>

                    <p><strong>Username:</strong> <span style="color:#2e6da4;">' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p><strong>Password:</strong> <span style="color:#2e6da4;">' . htmlspecialchars($password, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p>Please log in to the Alumni System at your earliest convenience to explore the features available to you. If you encounter any issues or have any questions, feel free to contact our support team.</p>
                    <p>We look forward to your participation in our alumni community.</p>
                    <p>Note :</p>
                     <p>To ensure the security of your account, please do not share your login credentials with anyone and consider changing your password regularly.</p>
                     <h2>Academics. <i style="color:red;">And Beyond!</i></h2>';
                     

    $mail->Body = $mailContent;

$mail->send();
$_SESSION['email'] = true;
header("location: ../registration/list.registration.php");
} catch(Exception $e){
    echo $email;
    echo "HI PRETTY";
}
    
    

 
?>

