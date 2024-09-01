<?php

require "connction.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo ("Please enter your First Name !!!");
} else if (strlen($fname) > 50) {
    echo ("First Name must have less than 50 characters");
} else if (empty($lname)) {
    echo ("Please enter your Last Name !!!");
} else if (strlen($lname) > 50) {
    echo ("Last Name must have less than 50 characters");
} else if (empty($email)) {
    echo ("Please enter your Email !!!");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($password)) {
    echo ("Please enter your Password !!!");
} else if (strlen($password) < 8 || strlen($password) > 20) {
    echo ("Password must be between 8 - 20 charcters");
} else if (empty($mobile)) {
    echo ("Please enter your Mobile !!!");
} else if (strlen($mobile) != 10) {
    echo ("Mobile must have 10 characters");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid Mobile !!!");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mobile . "'");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User with the same Email or Mobile already exists.");
    } else {

        Database::iud("INSERT INTO `user` 
        (`fname`,`lname`,`email`,`mobile`,`password`,`gender_id`,`status`) VALUES 
        ('" . $fname . "','" . $lname . "','" . $email . "','" . $mobile . "','" . $password . "','" . $gender . "','1')");

        echo "Account Create Successfully";
    }
}
