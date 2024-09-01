<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bttn.css" />
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">
    <div class=" container-fluid">
        <div class="row">
            <?php include "header.php" ?>

            <div class="col-12 mb-3">
                <div class="row">
                    <label class=" fw-bold fs-3 text-center">Watchlist</label>
                </div>
            </div>


            <?php
            require "connction.php";
            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email` ='" . $email . "'");
                $watchlist_num = $watchlist_rs->num_rows;



                if ($watchlist_num == 0) {
            ?>
                    <div class="mt-3 mb-3">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <img src="resource/watchlist.png" style="width: 20%;" />
                            </div>
                            <h1 class=" text-center">No items in Watchlist</h1>
                        </div>
                    </div>


                <?php
                } else {
                ?>

                    <?php

                    for ($x = 0; $x < $watchlist_num; $x++) {
                        $watchlist_data = $watchlist_rs->fetch_assoc();

                        $product_rs = Database::search("SELECT * FROM `product`WHERE `id` = '" . $watchlist_data["product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();

                        $color_rs = Database::search("SELECT * FROM `color` WHERE `id` ='" . $product_data["color_id"] . "'");
                        $color_data = $color_rs->fetch_assoc();

                        $shop_rs = Database::search("SELECT * FROM `shop` WHERE `user_email`='" . $product_data["user_email"] . "'");
                        $shop_data = $shop_rs->fetch_assoc();

                        $images_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                        $images_data = $images_rs->fetch_assoc();

                    ?>
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-9 d-grid ">
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="card mb-3 shadow">
                                                    <div class="row g-0 justify-content-center">
                                                        <div class="col-lg-3">
                                                            <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>'>
                                                                <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 210px;" alt="...">
                                                            </a>
                                                        </div>
                                                        <div class=" card-body col-lg-9">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-7 ">
                                                                        <label class=" text-primary fw-bold fs-5"><?php echo $product_data["title"]; ?></label><br>
                                                                        <span class="card-text text-black-50 mb-2  fs-6">Price: </span><label class="text-black fw-bold fs-6">Rs. <?php echo $product_data["price"]; ?></label><br>
                                                                        <span class="card-text text-black-50 mb-2 fs-6">Colour: </span><label class="text-black fs-6"><?php echo $color_data["name"]; ?></label><br>
                                                                        <span class="card-text text-black-50 mb-2 fs-6">Condition: </span><label class="text-black fs-6">Brand New</label><br>
                                                                        <span class="card-text text-black-50 mb-2 fs-6">Seller: </span><label class="text-black fs-6 "><?php echo $shop_data["shop_name"] ?></label><br>



                                                                    </div>
                                                                    <div class="col-12 col-lg-5 d-grid ">

                                                                        <div class="input-group input-group-sm mb-2 mt-2">
                                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                                                                            <input type="number" min="1" class="form-control" id="qty" value="1" aria-describedby="inputGroup-sizing-sm">
                                                                        </div>
                                                                        <button class="bttn-slant bttn-md bttn-warning mb-2 mt-3" onclick="addToCart(<?php echo $product_data['id']; ?>);"> Add to Cart</button>
                                                                        <button class="btn" onclick="deleteFromWatchlist(<?php echo $product_data['id']; ?>);"><i class="bi bi-trash text-danger"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-3 border-end border-secondary">


                                </div>

                            </div>
                        </div>
                    <?php
                    }
                    ?>

                <?php
                }
                ?>

            <?php
            } else {
                header("Location:home.php");
            }
            ?>

            <div style="height:300px;"></div>
            <?php include "footer.php" ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>