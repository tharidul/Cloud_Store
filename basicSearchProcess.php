<?php

$category = $_POST["cid"];
$txt = $_POST["title"];
$brand = $_POST["brand"];
$price_range = $_POST["price"];
$freeShipping = $_POST["freeShipping"];


session_start();
require "connction.php";


$query = "SELECT * FROM `product` INNER JOIN `shop` ON shop.sid = product.shop_sid WHERE 1 = 1 AND `shop_status_id` = '1' ";

if (!empty($txt)) {
    $query .= " AND `title` LIKE '%" . $txt . "%'";
}

if ($category != 0) {
    $query .= " AND `category_id` = '" . $category . "'";
}

if ($brand != 0) {
    $query .= " AND `brand_id` = '" . $brand . "'";
}

if (!empty($price_range)) {
    $query .= " AND `price` <= '" . $price_range . "'";
}

if ($freeShipping == 1) {
    $query .= " AND `delivary_fee` = '0' ";
}




?>

<div class="row justify-content-center">


    <div class="col-12 col-lg-11  ">
        <div class="row ">
            <?php

            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 24;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $categoryed_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $categoryed_num = $categoryed_rs->num_rows;

            for ($x = 0; $x < $categoryed_num; $x++) {
                $categoryed_data = $categoryed_rs->fetch_assoc();

            ?>

                <div class="col-8 mt-3 mb-3 col-lg-2 col-md-auto">
                    <div class="card shadow cardHome">
                        <?php
                        $image_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id` ='" . $categoryed_data["id"] . "'");
                        $image_data = $image_rs->fetch_assoc();
                        ?>
                        <a href='<?php echo "singleProductView.php?id=" . $categoryed_data["id"]; ?>'>
                            <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" alt="...">
                        </a>

                        <div class="card-body">
                            <style>
                                .card-title {
                                    font-size: 15px;
                                    white-space: nowrap;
                                }

                                @media only screen and (max-width: 767px) {

                                    /* adjust font size and maximum characters for smaller screens */
                                    .card-title {
                                        font-size: 12px;
                                        max-width: 80%;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                    }
                                }
                            </style>

                            <!-- card title with PHP code -->
                            <p class="card-title">
                                <?php
                                $title = $categoryed_data["title"];
                                $max_chars = 17; // set the maximum number of characters here
                                if (strlen($title) > $max_chars) {
                                    echo substr($title, 0, $max_chars) . '...';
                                } else {
                                    echo $title;
                                }
                                ?>
                            </p>

                            <?php
                            $price_with_currency = 'LKR ' . number_format($categoryed_data["price"], 2);
                            ?>

                            <h6 class="card-title"><b><?php echo $price_with_currency;?></b></h6>
                        </div>
                    </div>
                </div>

            <?php

            }
            ?>



        </div>
    </div>
    <!--  -->
    <div class="col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->
</div>