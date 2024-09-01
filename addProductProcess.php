<?php

session_start();

require "connction.php";

$email = $_SESSION["u"]["email"];

$title = $_POST["t"];
$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$price = $_POST["p"];
$ship = $_POST["s"];
$desc = $_POST["d"];
$qty = $_POST["q"];
$color = $_POST["clr"];

if (empty($title)) {
    echo ("Please add the Title");
} else if (strlen($title) >= 100) {
    echo ("Title should have less than 100 characters");
} else if ($category == "0") {
    echo ("Please select a Category");
} else if ($brand == "0") {
    echo ("Please select a Brand");
} else if ($model == "0") {
    echo ("Please select a Model");
} else if ($color == "0") {
    echo ("Please select a Colour");
} else if (empty($price)) {
    echo ("Please add the Price");
} else if (empty($qty)) {
    echo ("Please add the Quantity");
} else if ($qty == "0" | $qty == "e" | $qty < 0) {
    echo ("Invalid value for field Quantity");
} else if (!is_numeric($ship)) {
    echo ("Invalid value for field Delivery cost");
} else if (!is_numeric($ship)) {
    echo ("Invalid value for field Delivery cost");
} else {

    $bhm_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id` = '" . $model . "' AND `brand_id` = '" . $brand . "'");

    $brand_has_model_id;

    if ($bhm_rs->num_rows > 0) {

        $bhm_data = $bhm_rs->fetch_assoc();
        $brand_has_model_id = $bhm_data["id"];
    } else {

        Database::iud("INSERT INTO `brand_has_model` (`model_id` , `brand_id`) VALUES
        ('" . $model . "','" . $brand . "') ");

        $brand_has_model_id = Database::$connection->insert_id;
    }


    $status = 1;

    $shop_rs = Database::search("SELECT * FROM `shop` WHERE `user_email` = '".$email."'");
    $shop_data = $shop_rs->fetch_assoc();
    $shop_id = $shop_data["sid"];

    Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`title`,`delivary_fee`,`brand_has_model_id`,`category_id`,`color_id`,`status_id`,`user_email`, `shop_sid`,`brand_id`) VALUES
     ('" . $price . "','" . $qty . "','" . $desc . "','" . $title . "','" . $ship . "','" . $brand_has_model_id . "','" . $category . "','" . $color . "','" . $status . "','" . $email . "','".$shop_id."','".$brand."')");

    echo ("Product added Successfully");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length = 3) {

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {
        
                $image_file = $_FILES["image" . $x];
                $file_extention = $image_file["type"];
        
                if (in_array($file_extention, $allowed_image_extentions)) {
        
                    // Check if GD library is enabled
                    if (!function_exists('imagecreatefromstring')) {
                        echo "GD library is not enabled";
                        exit;
                    }
        
                    // Load the image using GD
                    $image = imagecreatefromstring(file_get_contents($image_file["tmp_name"]));
        
                    // Get the dimensions of the image
                    $width = imagesx($image);
                    $height = imagesy($image);
        
                    // Check if the aspect ratio is 1:1
                    if ($width == $height) {
        
                        $new_img_extention;
        
                        if ($file_extention == "image/jpg") {
                            $new_img_extention = ".jpg";
                        } else if ($file_extention == "image/jpeg") {
                            $new_img_extention = ".jpeg";
                        } else if ($file_extention == "image/png") {
                            $new_img_extention = ".png";
                        } else if ($file_extention == "image/svg+xml") {
                            $new_img_extention = ".svg";
                        }
        
                        $file_name = "resource/mobile_images/" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                        move_uploaded_file($image_file["tmp_name"], $file_name);
        
                        Database::iud("INSERT INTO `p_images`(`code`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
                    } else {
                        echo ("Image aspect ratio is not 1:1");
                    }
        
                    // Free up memory
                    imagedestroy($image);
        
                } else {
                    echo ("Not an allowed image type");
                }
            }
        }
        

    } else {
        echo ("Invalid Image Count");
    }
}
