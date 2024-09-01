<?php
session_start();
require "connction.php";

$pid = $_POST["pid"];
$user_email = $_POST["uid"];
$oid = $_POST["oid"];
$feedback = $_POST["fb"];
$currentDateTime = date('Y-m-d H:i:s');

$feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `user_email` = '".$user_email."' AND `product_id` = '".$product."' ");

Database::iud("INSERT INTO `feedback` (`review`,`product_id`,`user_email`,`order_id`,`date_time`)VALUES
('".$feedback."','".$pid."','".$user_email."','".$oid."','".$currentDateTime."')");

echo("done");
?>