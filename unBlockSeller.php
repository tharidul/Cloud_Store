<?php
session_start();
if(isset($_SESSION["au"])){
    $id = $_GET["id"];
    require "connction.php";

    Database::iud("UPDATE `shop` SET `shop_status_id` = '1' WHERE `sid` = '".$id."'");

    echo("done");

}else{
    header("adminSignIn.php");
}
?>