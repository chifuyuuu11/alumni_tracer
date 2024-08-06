<?php
session_start();
require '../../../includes/conn.php';
require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateOTP()
{
    return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

function sendOTPEmail($email, $otp)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'stfrancisbacoor.pass.reset@gmail.com';
        $mail->Password = 'islqiaavsjlrgoyf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('sfacbacoor1981@gmail.com', 'SFAC-Bacoor');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password | One Time Password Verification';
        $mail->Body = "
        <html>
        <body>
            <h1 style='color:red;'>Hello Fellow Franciscan!</h1>
            Your OTP code is:<br>
            <strong style='font-size:35px;'>$otp</strong><br><br>
            This 6-digit code is to reset the password for your account. Please enter it to verify your request.<br><br>
            SFAC-Bacoor representatives will never ask for this code. For your protection, please do not share this code with anyone.<br><br>
            Thank you!<br>
            Saint Francis of Assisi College<br><br>
            #BeOneOfUs
            <h2>Academics. <i style='color:red;'>And Beyond.</i></h2>
            All rights reserved.
        </body>
        </html>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendPasswordChangeEmail($email)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'stfrancisbacoor.pass.reset@gmail.com';
        $mail->Password = 'islqiaavsjlrgoyf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('sfacbacoor1981@gmail.com', 'SFAC-Bacoor');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password | Password Changed Successfully';
        $mail->Body = "
        <html>
        <body>
        <h1 style='color:red;'>Hello Fellow Franciscan!</h1>
            We wanted to inform you that your password was successfully changed.<br><br>
            If you did not make this change or believe an unauthorized person has accessed your account, please contact our support team immediately.<br><br>
            Thank you for helping us keep your account secure.<br><br>
            Best Regards,<br>
            Saint Francis of Assisi College<br><br>
            #BeOneOfUs
            <h2>Academics. <i style='color:red;'>And Beyond.</i></h2>
            All rights reserved.
        </body>
        </html>";

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
        header('Location: ../forgot.password.php?email_not_found=true');
        exit();
    }
}

if (isset($_POST['reset-otp'])) {
    $otp = $_POST['otp'];

    if ($otp == $_SESSION['otp']) {
        header('Location: ../new.password.php');
        exit();
    } else {
        header('Location: ../reset.code.php?invalid_otp=true');
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
            sendPasswordChangeEmail($email);
            $_SESSION['password_success'] = true;
            header('Location: ../login.php?password_reset=success');
            exit();
        } else {
            header('Location: ../new.password.php?error=change_password');
            exit();
        }
    } else {
        header('Location: ../new.password.php?error=password_mismatch');
        exit();
    }
}
?>