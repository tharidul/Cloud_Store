<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.png" />
    <link rel="stylesheet" href="bttn.css" />
</head>

<body class="back">
    <div class="container-fluid">

        <div class="row ">
            <?php include "header.php" ?>

            <div class="col-12 mb-3">
                <div class="row">
                    <label class=" fw-bold fs-3 text-center">My Orders</label>
                </div>
            </div>


            <?php
            require "connction.php";
            if (isset($_SESSION["u"])) {

                $shop_rs = Database::search("SELECT * FROM `shop` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "'");
                $shop_data = $shop_rs->fetch_assoc();
                $shop_id = $shop_data["sid"];
            ?>


                <div class=" col-lg-9 col-12">

                    <?php
                    $orders_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON product.id = invoice.product_id WHERE invoice.invoice_shop_sid = '" . $shop_id . "' AND `shipping_status_id` = '1' ORDER BY invoice.id DESC");
                    $oders_num = $orders_rs->num_rows;

                    if ($oders_num == 0) {

                    ?>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <img src="resource/cart.png" style="width: 20%;" />
                            </div>
                            <h1 class=" text-center">No Order yet !!!</h1>
                        </div>
                    <?php

                    } else {

                    ?>
                        <div class=" col-12 my-3">

                            <?php
                            $invoiceQty_rs = Database::search("SELECT * FROM `invoice` WHERE `invoice_shop_sid` = '" . $shop_id . "' AND `shipping_status_id` = '1' ORDER BY invoice.id DESC");

                            $image_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `p_images` ON invoice.product_id = p_images.product_id
                            INNER JOIN `user_has_address` ON user_has_address.user_email = invoice.user_email 
                            INNER JOIN `city` ON city.id = user_has_address.city_id
                            INNER JOIN `user` ON user.email = invoice.user_email WHERE `invoice_shop_sid` = '" . $shop_id . "' AND `shipping_status_id` = '1' ORDER BY invoice.id DESC");



                            for ($x = 0; $x < $oders_num; $x++) {
                                $oder_data = $orders_rs->fetch_assoc();
                                $invoiceQty_Data = $invoiceQty_rs->fetch_assoc();
                                $image_data = $image_rs->fetch_assoc();
                                $subTotal = ($oder_data["price"]) * ($invoiceQty_Data["qty"]);
                                $shipping = $oder_data["delivary_fee"];
                                $grandTotal = $subTotal + $shipping;

                            ?>


                                <div class="card bg-dark text-white my-3">
                                    <h5 class="card-header"><?php echo $oder_data["title"]; ?> </h5>

                                    <div class="card-body">
                                        <div class="row justify-content-center">

                                            <div class=" col-lg-2 col-12 mb-3">
                                                <div class="row justify-content-center">
                                                    <img class=" img-fluid img-thumbnail" src="<?php echo $image_data["code"] ?>">
                                                </div>
                                            </div>

                                            <div class=" col-lg-3 col-6 mt-md-3 mt-sm-3">
                                                <span class="mb-2">Unit Price : </span> <span class="card-text fw-bold fs-6 mb-2">LKR <?php echo number_format($oder_data["price"], 2, '.', ','); ?></span><br>
                                                <span class="mb-2">Qty : </span> <span class="mb-2 card-text"><?php echo $invoiceQty_Data["qty"]; ?></span><br>
                                                <span class="mb-2">Grand Total : </span><span class="mb-2">LKR <?php echo number_format($grandTotal, 2, '.', ','); ?></span><br>
                                            </div>



                                            <div class=" col-lg-5 col-6 mt-md-3 mt-sm-3">
                                                <Span class="mb-2">Name: </Span><span class=" fw-bold fs-6 mb-2"><?php echo $image_data["fname"]; ?> <?php echo $image_data["lname"]; ?></span><br>
                                                <span class="mb-2">Address :</span> <span class=" fw-bold fs-6 mb-2"><?php echo $image_data["line1"] ?><?php echo $image_data["line2"] ?></span><br>
                                                <span class="mb-2">Postal Code : </span><span class=" fw-bold fs-6 mb-2"><?php echo $image_data["postal_code"] ?></span><br>
                                                <span class="mb-2">City : </span><span class=" fw-bold fs-6 mb-2"><?php echo $image_data["name"] ?></span><br>
                                            </div>

                                            <div class=" d-flex col-lg-2 col-12 align-items-center justify-content-center ">

                                                <button class=" btn btn-success" onclick="sellerConfirm();">Order Confirm</button>

                                                <input type="hidden" id="p_id" value="<?php echo $invoiceQty_Data["product_id"]; ?>">
                                                <input type="hidden" id="o_id" value="<?php echo $invoiceQty_Data["order_id"]; ?>">
                                                <input type="hidden" id="u_id" value="<?php echo $invoiceQty_Data["user_email"]; ?>">


                                            </div>

                                        </div>
                                    </div>




                                </div>

                            <?php
                            }
                            ?>

                        </div>
                    <?php

                    }
                    ?>

                </div>

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