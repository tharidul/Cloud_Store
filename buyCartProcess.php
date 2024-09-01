<?php
session_start();
require "connction.php";

if(isset($_SESSION["u"])){

    $cart_tem_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '".$_SESSION["u"]["email"]."'");

    $umail = $_SESSION["u"]["email"];

    $order_id = uniqid();

    $total_amount = 0;

    $merchant_id ="1222920";
    $merchant_secret ="MzMyNjczMDkxMTQyNzQ5MzE2MDczODk5NjAwOTYxNDE0OTg5NDcwNQ==";
    $currency = "LKR";

    $items = array(); // an array to store items information for the order

    while ($cart_tem_data = $cart_tem_rs->fetch_assoc()) {

        $id = $cart_tem_data['product_id'];
        $qty = $cart_tem_data['qty'];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
        $product_data = $product_rs->fetch_assoc();

        $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
        $city_num = $city_rs->num_rows;

        if($city_num == 1){
            $city_data = $city_rs->fetch_assoc();

            $city_id = $city_data["city_id"];
            $address = $city_data["line1"].",".$city_data["line2"];

            $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$city_id."'");
            $district_data = $district_rs->fetch_assoc();

            $district_id = $district_data["district_id"];
            $delivery = $product_data["delivary_fee"];

            $item = $product_data["title"];
            $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

            $total_amount += $amount;

            $items[] = array(
                "id" => $product_data["id"],
                "item" => $item,
                "qty" => $qty,
                "price" => $product_data["price"],
                "delivery_fee" => $delivery
            );

        }else{
            echo("2");
            exit;
        }
    }

    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $uaddress = $address;
    $city = $district_data["name"];

    $hash = strtoupper(
        md5(
            $merchant_id . 
            $order_id . 
            number_format($total_amount, 2, '.', '') . 
            $currency .  
            strtoupper(md5($merchant_secret)) 
        ) 
    );

    $array["oid"] = $order_id;
    $array["hash"] = $hash;
    $array["amount"] = $total_amount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["address"] = $uaddress;
    $array["city"] = $city;
    $array["umail"] = $umail;
    $array["items"] = $items;

    echo json_encode($array);

} else {
    echo ("1");
}

?>