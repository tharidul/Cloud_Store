<?php
require "connction.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

$email = $_POST["email"];

$rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' ");

use PHPMailer\PHPMailer\PHPMailer;

if ($rs->num_rows == 1) {

    $code = sprintf("%06d", mt_rand(0, 999999));


    Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lakbro100@gmail.com';
    $mail->Password = 'enawimtxthaitvgb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('lakbro100@gmail.com', 'Cloud Store Account Password Reset');
    $mail->addReplyTo('lakbro100@gmail.com', 'Admin Verification');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Cloud Store Account Password Change';
    $bodyContent = '<div class="d-none">
    <div id="emaildiv">
        <div style="max-width: 600px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div style="background-color: #007BFF; color: #fff; padding: 10px 0; text-align: center; font-size: 24px;">
                Cloud Store Account Recovery
            </div>

            <div style="padding: 20px; text-align: center;">
                <h1 style="color: #007BFF; margin-bottom: 20px;">Password Recovery</h1>
                <p>Hi there,</p>
                <p>We received a request to reset the password for your Cloud Store account associated with <strong>'.$email.'</strong>.</p>
                <p>Your One-Time Password (OTP) for account recovery is:</p>
                <div style="font-size: 36px; color: #007BFF; margin-bottom: 20px; display: inline-block; padding: 10px 20px; border: 1px dashed #007BFF; border-radius: 5px; background-color: #f0f8ff;">'.$code.'</div>
                <p>Please use this OTP to complete your password recovery process.</p>
                <p>If you did not request a password reset, please ignore this email or contact support if you have any concerns.</p>
            </div>

            <div style="background-color: #f0f8ff; color: #333; padding: 10px 0; text-align: center; font-size: 14px; border-top: 1px solid #ddd; margin-top: 20px;">
                &copy; 2023 <a href="https://cloudstore.lk/" style="color: #007BFF; text-decoration: none;">Cloud Store</a>. All rights reserved.
            </div>
        </div>
    </div>
</div>
';
    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo 'Verification code sending failed';
    } else {
        echo 'success';
    }
} else {
    echo "userNotFound";
}
