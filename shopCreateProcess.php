<?php

session_start();
require "connction.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $sname = $_POST["sn"];
    $smobile = $_POST["sm"];
    $sline1 = $_POST["sl1"];
    $sline2 = $_POST["sl2"];
    $scity = $_POST["sc"];
    $sdistrict = $_POST["sd"];
    $rnumber = $_POST["rn"];

    if(empty($sname)){
        echo("Please Enter your Shop Name !");
    }else if (strlen($sname) > 50) {
        echo ("Shop Name must have less than 50 characters !");
    }else if(empty($rnumber)){
        echo ("Please Enter Bussiness Registration Number");
    }else if(empty($smobile)){
        echo ("Please Enter Shop Mobile No.");
    }else if (empty($sline1)) {
        echo ("Please Enter shop Address");
    }else if (empty($sline2)) {
        echo ("Enter shop Address");
    }else if (empty($scity)) {
        echo ("Select City");
    }else if (empty($sdistrict)) {
        echo ("Select District");
    }else{

        $rs = Database::search("SELECT * FROM `shop` WHERE `user_email`='".$email."' AND `r_number` ='".$rnumber."'");
        $n = $rs->num_rows;
        
        if($n > 0){
            echo ("User with the same Email or Mobile already exists.");
        }else{
        
            Database::iud("INSERT INTO `shop` 
            (`user_email`,`shop_name`,`shop_mobile`,`s_line1`,`s_line2`,`city_id`,`r_number`,`shop_status_id`) VALUES 
            ('".$_SESSION["u"]["email"]."','".$sname."','".$smobile."','".$sline1."','".$sline2."','".$scity."','".$rnumber."','2')");
        
            echo ("done");
        }
    }

    
} else {

    echo ("Please Login first !!!");
}

?>


