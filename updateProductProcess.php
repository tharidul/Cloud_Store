<?php

session_start();

require "connction.php";

$email = $_SESSION["u"]["email"];

$title = $_POST["t"];
$price = $_POST["p"];
$ship = $_POST["s"];
$desc = $_POST["d"];
$qty = $_POST["q"];
$pid = $_POST["pid"];


if (empty($title)) {
    echo ("Please add the Title");
} else if (strlen($title) >= 100) {
    echo ("Title should have less than 100 characters");
} else if (empty($price)) {
    echo ("Please add the Price");
} else if (empty($qty)) {
    echo ("Please add the Quantity");
} else if ($qty == "0" | $qty == "e" | $qty < 0) {
    echo ("Invalid value for field Quantity");
} else if (!is_numeric($ship)) {
    echo ("Invalid value for field Delivery cost");
} else {

   Database::iud("UPDATE `product` SET`title`='".$title."',`price`='".$price."',
   `qty` = '".$qty."',`description`= '".$desc."', `delivary_fee`='".$ship."' WHERE `id` = '".$pid."'");

 

        echo ("Product Updated");
}
