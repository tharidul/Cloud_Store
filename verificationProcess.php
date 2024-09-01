<?php

session_start();
require "connction.php";

if(isset($_GET["v"])){

    $v = $_GET["v"];

    $admin = Database::search("SELECT * FROM `admin` WHERE `v_code`='".$v."'");
    $num = $admin->num_rows;

    if($num == 1){
        $data = $admin->fetch_assoc();
        $_SESSION["au"]=$data;
        echo("success");
    
    }else{
        echo ("invalid verification code.");
    }

}else{
    echo ("please enter your verificaion code");
}

?>