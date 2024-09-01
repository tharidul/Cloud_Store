<?php
require "connction.php";

    if(isset($_GET["id"])){

        $pid = $_GET["id"];

        Database::iud(" DELETE FROM `cart` WHERE `product_id` = '".$pid."'");

        echo("Product Removed");

    }else{
       echo("something went wrong");
    }

?>