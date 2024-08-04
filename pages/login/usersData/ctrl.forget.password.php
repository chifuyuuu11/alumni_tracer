<?php
session_start();
require '../../../includes/conn.php';
require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateOTP() {
    return rand(000000, 999999);
}

function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'stfrancisbacoor.pass.reset@gmail.com';
        $mail->Password   = 'islqiaavsjlrgoyf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('sfacbacoor1981@gmail.com','SFAC-Bacoor');
        $mail->addAddress($email);


        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is: $otp";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['forgotpassword'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM tbl_users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        sendOTPEmail($email, $otp);

        header('Location: ../reset.code.php');
        exit();
    } else {
        echo "Email does not exist!";
    }
}

if (isset($_POST['reset-otp'])) {
    $otp = $_POST['otp'];

    if ($otp == $_SESSION['otp']) {
        header('Location: ../new.password.php');
        exit();
    } else {
        echo "Invalid OTP!";
    }
}

if (isset($_POST['change-password'])) {
    $password = $_POST['password'];
    $changepassword = $_POST['changepassword'];

    if ($password == $changepassword) {
        $email = $_SESSION['email'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE tbl_users SET password = '$hashed_password' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: ../login.php');
            session_destroy();
        } else {
            echo "There was an error changing your password!";
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>