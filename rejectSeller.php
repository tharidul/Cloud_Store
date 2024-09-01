<?php
session_start();
if(isset($_SESSION["au"])){
    require "connction.php";
    $id= $_GET["id"];


    Database::iud("DELETE FROM `shop` WHERE `sid` = '".$id."'");

    echo("done");
}else{

    header("adminSignIn.php");
}

?>