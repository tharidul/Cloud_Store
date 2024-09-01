<?php
require "connction.php";


    if(isset($_GET["id"])){

        $pid = $_GET["id"];

        Database::iud(" DELETE FROM `watchlist` WHERE `product_id` = '".$pid."'");

        echo("Product Removed");



    }else{
       echo("something went wrong");
    }


?>