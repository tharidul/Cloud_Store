<?php

session_start();
require "connction.php";

if(isset($_SESSION["u"])){

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $current_qty = $product_data["qty"];
    $new_qty = $current_qty - $qty;
    $shop_sid = $product_data["shop_sid"];

    Database::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$pid."'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date_time`,`total`,`qty`,`product_id`,`user_email`,`shipping_status_id`,`invoice_shop_sid`) VALUES 
    ('".$order_id."','".$date."','".$amount."','".$qty."','".$pid."','".$mail."','1','".$shop_sid."')");

    echo ("1");

}

?>