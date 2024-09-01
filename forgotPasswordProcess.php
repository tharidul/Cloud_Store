<?php
require "connction.php";

$email = $_POST["email"];
$newPw = $_POST["newPw"];
$otp = $_POST["otp"];


$user_rs = Database::search("SELECT * FROM `user` WHERE `verification_code` = '".$otp."' AND `email` = '".$email."' ");

if($user_rs->num_rows == 1){
    Database::iud("UPDATE  `user` SET `password` = '".$newPw."' WHERE `email` = '".$email."' ");
    echo "success";
}else{
echo "Invalid OTP";

}






?>