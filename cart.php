<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.png" />
    <link rel="stylesheet" href="bttn.css" />
</head>

<body class="back">
    <div class="container-fluid">

        <div class="row">
            <?php include "header.php" ?>

            <div class="col-12 mb-3">
                <div class="row">
                    <label class=" fw-bold fs-3 text-center">Shopping Cart</label>
                </div>
            </div>


            <?php
            require "connction.php";
            if (isset($_SESSION["u"])) {

                $subtotal = 0;
                $total = 0;
                $totalShip = 0;

                $email = $_SESSION["u"]["email"];

                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $email . "'");
                $cart_num = $cart_rs->num_rows;
                if ($cart_num == 0) {

            ?>
                    <div>

                        <div class="col-12 p-5">
                            <div class="row justify-content-center">
                                <img src="resource/cart.png" style="width: 20%;" />
                            </div>
                            <h1 class=" text-center">Cart is Empty !!!</h1>
                        </div>

                    </div>
                <?php


                } else {
                ?>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-7 d-grid ">

                                <div class="col-12">
                                    <div class="row">


                                        <?php


                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $image_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id` ='" . $product_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `color` ON color.id = product.color_id 
                                   INNER JOIN `shop` ON shop.user_email = product.user_email INNER JOIN `cart` ON cart.Product_id = product.id  WHERE product.id='" . $product_data["id"] . "'");
                                            $details_data = $details_rs->fetch_assoc();

                                            $subtotal = $subtotal + ($product_data["price"] * $cart_data["qty"]);
                                            $totalShip = $totalShip + $product_data["delivary_fee"];

                                            $total = $subtotal + $totalShip;

                                        ?>
                                            <div class="card mb-3 shadow">
                                                <div class="row g-0 justify-content-center">
                                                    <div class="col-lg-3">
                                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" style="height: 210px;" alt="...">
                                                    </div>
                                                    <div class=" card-body col-lg-9">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6 mb-3">
                                                                    <label class=" text-primary fw-bold fs-5"><?php echo $product_data["title"]; ?></label><br>
                                                                    <span class="card-text text-black-50 mb-2  fs-6">Price: </span><label class="text-danger fw-bold fs-6"><?php echo $product_data["price"]; ?></label><br>
                                                                    <span class="card-text text-black-50 mb-2 fs-6">Colour: </span><label class="text-black fs-6"><?php echo $details_data["name"]; ?></label><br>
                                                                    <span class="card-text text-black-50 mb-2 fs-6">Seller: </span><label class="text-black fs-6 "><?php echo $details_data["shop_name"] ?></label><br>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" class="form-control" min="1" placeholder="Add Quantity" id="cart_qty_<?php echo $product_data['id']; ?>" value="<?php echo $details_data["qty"]; ?>" onchange="cart_qty(<?php echo $product_data['id']; ?>);">

                                                                    </div>
                                                                    <span class="card-text text-black-50 fs-6">Shipping Fee: </span><label class="text-black fs-6 ">
                                                                        <?php echo ($product_data["delivary_fee"] > 0) ? 'Rs.' . $product_data["delivary_fee"] : 'Free Shipping'; ?>
                                                                    </label>
                                                                    <br>

                                                                    <div class="col-12 text-end">
                                                                        <button class="btn btn-outline-danger mt-2" onclick="removeFormCart(<?php echo $product_data['id']; ?>)"><i class="bi bi-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-5">
                                <div class="row justify-content-center">

                                    <div class="col-12 col-lg-11 text-center">
                                        <label class="text-black fs-3 fw-bold  ">Summary</label>

                                        <div class="text-black">
                                            <hr>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-11 text-center mb-3">
                                        <div class="row justify-content-center text-black">
                                            <div class="col-6 ">
                                                <span class=" fs-5">Sub Total (2)</span>
                                                <br><br>
                                                <span class=" fs-5">Total Shipping Fee</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="fs-5 fw-bold ">Rs.<?php echo $subtotal ?>.00</span>
                                                <br><br>
                                                <span class="fs-5 fw-bold">
                                                    <?php
                                                    if ($totalShip == 0) {
                                                        echo "Free Shipping";
                                                    } else {
                                                        echo "Rs.{$totalShip}.00";
                                                    }
                                                    ?>
                                                </span>

                                            </div>

                                            <div class="text-black">
                                                <hr>
                                            </div>

                                            <div class="col-6 ">
                                                <span class=" fs-4 fw-bold">Total</span>
                                            </div>

                                            <div class="col-6">
                                                <span class="fs-4 fw-bold">Rs. <?php echo number_format($total, 2, '.', '  '); ?></span>

                                            </div>

                                            <div class="text-black">
                                                <hr>
                                            </div>

                                            <div class="col-8 d-grid">
                                                <button class="btn btn-warning fs-4" type="submit" id="payhere-payment" onclick="cartPayNow();">Cheackout</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

            <?php
            } else {
                header("Location:home.php");
            }
            ?>

            <?php include "footer.php" ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="cartPayment.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>