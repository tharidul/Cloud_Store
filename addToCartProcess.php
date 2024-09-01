<?php
 session_start();
  require "connction.php";

  if(isset($_SESSION["u"])){

$pid = $_POST["pid"];
$qty = $_POST["qty"];
$email = $_SESSION["u"]["email"];

       $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id` = '".$pid."' AND `user_email` = '".$email."'");
       $cart_num = $cart_rs->num_rows;

       $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
       $product_data = $product_rs->fetch_assoc();
       $product_qty = $product_data["qty"];

       if($cart_num == 1){

        echo("Already Product Added");

       }else{

        if($product_qty >= $qty){

          Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`) VALUES ('".$pid."','".$email."','".$qty."')");
          echo("Product added to cart ");

        }else{
          echo("Invalid Product Count");
        }
       }

  }else{
    header("home.php");
  }
