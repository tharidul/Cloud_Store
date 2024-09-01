<?php

session_start();
require "connction.php";

if (isset($_SESSION["au"])) {

    $status_id = $_GET["status"];
    $email = $_GET["em"];

    if($status_id == 1){
        Database::iud("UPDATE `user` SET `status` ='2' WHERE `email`= '".$email."'");
        echo("User Deactivated");
    }else{
        Database::iud("UPDATE `user` SET `status` ='1' WHERE `email`= '".$email."'");
        echo("User Activated");
    }
    



} else {

    header("Location: adminSignIn.php");
}

?>