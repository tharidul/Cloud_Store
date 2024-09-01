<?php

require "connction.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["em"])) {
    $email = $_POST["em"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_mail`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `v_code`='" . $code . "' WHERE `admin_mail`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tharidu.java@gmail.com';
        $mail->Password = 'hvqfmzgzarazdngm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('tharidu.java@gmail.com', 'Admin Verification');
        $mail->addReplyTo('tharidu.java@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Admin Login Verification Code';
        $bodyContent = '<div class="d-none">
    <div id="emaildiv">
        <div style="max-width: 600px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div style="background-color: #007BFF; color: #fff; padding: 10px 0; text-align: center; font-size: 24px;">
                Cloud Store Admin Verification
            </div>

            <div style="padding: 20px; text-align: center;">
                <h1 style="color: #007BFF; margin-bottom: 20px;">Verification Code</h1>
                <p>Hi there,</p>
                <p>We received a request for an admin sign-in to the Cloud Store.</p>
                <p>Your One-Time Password (OTP) for verification is:</p>
                <div style="font-size: 36px; color: #007BFF; margin-bottom: 20px; display: inline-block; padding: 10px 20px; border: 1px dashed #007BFF; border-radius: 5px; background-color: #f0f8ff;">' . $code . '</div>
                <p>Please use this OTP to complete your sign-in process.</p>
                <p>If you did not request this, please ignore this message or contact support if you have any concerns.</p>
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
            echo 'Success';
        }
    } else {
        echo ("You are not a valid user");
    }
} else {
    echo ("Email field should not be empty.");
}
