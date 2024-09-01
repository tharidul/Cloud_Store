<?php

require "connction.php";

if (isset($_GET["c"])){
    $category_id = $_GET["c"];

    $brand_rs = Database::search("SELECT * FROM `category_has_brand` INNER JOIN `brand` ON brand.id = category_has_brand.brand_id  WHERE `category_id` = '".$category_id."'");
    $brand_num = $brand_rs->num_rows;

    if ($brand_num > 0){
        $options = "";
        while ($brand_data = $brand_rs->fetch_assoc()) {
            $options .= '<option value="'.$brand_data["id"].'">'.$brand_data["name"].'</option>';
        }
        echo $options;
    } else {
        $all_brands = Database::search("SELECT * FROM `brand`");
        $options = "";
        while ($all_data = $all_brands->fetch_assoc()) {
            $options .= '<option value="'.$all_data["id"].'">'.$all_data["name"].'</option>';
        }
        echo $options;
    }
}

?>
