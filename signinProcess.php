<?php
require "connction.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($email)) {
    echo ("Please enter your Email");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must have between 5-20 characters");
} else {
    if ($rememberme == "true") {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365); // 1 year
    } else {
        ini_set('session.cookie_lifetime', 0);
    }

    session_start();

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' 
    AND `password`='" . $password . "' AND `status` = '1'");
    $n = $rs->num_rows;

    if ($n == 1) {
        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d; // Store user data in $_SESSION["u"]
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
    } else {
        echo ("Invalid Username or Password");
    }
}
?>
