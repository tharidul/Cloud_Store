<?php
session_start();
require "connction.php";
if (isset($_SESSION["u"])) {
    $pid = $_POST["pid"];
    $state = $_POST["state"];

    $state = intval($state);

    
    if($state == 1){
        Database::iud("UPDATE `product` SET `status_id` = '1' WHERE `id`= '".$pid."'");
        echo "Product Activated";
    }else{
        Database::iud("UPDATE `product` SET `status_id` = '2' WHERE `id`= '".$pid."'"); 
        echo "Product Deactivated";
    }


    
    
}
