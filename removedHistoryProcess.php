<?php
session_start();
$pid = $_GET["pid"];
$oid = $_GET["oid"];
require "connction.php";
if(isset($_SESSION["u"])){

    Database::iud("UPDATE `invoice` SET `shipping_status_id`='3' WHERE `product_id` = '".$pid."' AND `order_id` = '".$oid."' ");

    echo("done");

}else{
    header("home.php");
}
?>