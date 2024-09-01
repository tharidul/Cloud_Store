<?php
 session_start();
  require "connction.php";

  if(isset($_SESSION["u"])){

$pid = $_POST["pid"];
$qty = $_POST["nq"];
$email = $_SESSION["u"]["email"];

       $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
       $product_data = $product_rs->fetch_assoc();
       $product_qty = $product_data["qty"];

        $new_qty = (int)$qty;

        if($product_qty >=$new_qty){

          Database::iud("UPDATE `cart` SET `qty` ='".$new_qty."' WHERE `product_id` = '".$pid."' AND `user_email` = '".$email."' ");

          echo("Product Updated");

          }else{
              echo ("Invalid Quantity");
          }

       


    header("home.php");
  }
