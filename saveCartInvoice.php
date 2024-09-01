<?php

session_start();
require "connction.php";

if (isset($_SESSION["u"])) {

    $order_id = $_POST["o"];
    $user_mail = $_POST["m"];
    $ids = json_decode($_POST['i']);

    // Loop through each product ID and insert into invoice table
    foreach ($ids as $pid) {
        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id` = '" . $pid . "' AND `user_email` = '" . $user_mail . "'");
        $cart_data = $cart_rs->fetch_assoc();

        $current_qty = $product_data["qty"];
        $new_qty = $current_qty - $cart_data["qty"];

        $shop_id_rs = Database::search("SELECT * FROM `shop` INNER JOIN `product` ON product.shop_sid = shop.sid WHERE id = '".$pid."' ");
        $shop_id_data = $shop_id_rs->fetch_assoc();

        $shop_id = $shop_id_data["sid"];

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `invoice`(`order_id`,`date_time`,`total`,`qty`,`product_id`,`user_email`,`shipping_status_id`,`invoice_shop_sid`) VALUES 
        ('" . $order_id . "','" . $date . "','" . $product_data["price"] . "','" . $cart_data["qty"] . "','" . $pid . "','" . $user_mail . "','1','".$shop_id."')");

        Database::iud("DELETE FROM `cart` WHERE `user_email`='" . $user_mail . "' AND `product_id` = '".$pid."'");
    }

    echo ("1");
}
