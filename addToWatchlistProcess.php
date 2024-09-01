<?php 
require "connction.php";
session_start();
if(isset($_SESSION["u"])){

if(isset($_GET["id"])){

    $pid = $_GET["id"];
    $email = $_SESSION["u"]["email"];

    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."' AND `product_id` = '".$pid."' ");
    $watchlist_num = $watchlist_rs->num_rows;

    if($watchlist_num == 1){

        echo ("Already Added to Watchlist");
    }else{

        Database::iud("INSERT INTO `watchlist` (`user_email`,`product_id`) VALUES ('".$email."','".$pid."')");

        echo("Product added to Watchlist");
    }
}else{
    echo("Something went wrong");
}

}else{
    header("home.php");
}
?>