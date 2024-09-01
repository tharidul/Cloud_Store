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

        <div class="row justify-content-center min-vh-100">
            <?php include "header.php" ?>

            <div class="col-12 mb-3">
                <div class="row">
                    <label class=" fw-bold fs-3 text-center">My Orders</label>
                </div>
            </div>


            <?php
            require "connction.php";
            if (isset($_SESSION["u"])) {


            ?>
                <?php
                $orders_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON product.id = invoice.product_id WHERE invoice.user_email = '" . $_SESSION["u"]["email"] . "' AND `shipping_status_id` = '1' ORDER BY invoice.id DESC");
                $oders_num = $orders_rs->num_rows;

                if($oders_num==0){

                    ?>
                     <div class="col-12">
                            <div class="row justify-content-center">
                                <img src="resource/cart.png" style="width: 20%;" />
                            </div>
                            <h1 class=" text-center">No Order yet !!!</h1>
                        </div>
                    <?php

                }else{

                    ?>
                    <div class="col-10">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th class="text-center" width="20%">Cost per unit</th>
                                <th class="text-center" width="5%">QTY</th>
                                <th class="text-right" width="20%">Grand total</th>
                                <th class="text-right" width="20%"> Oder Confirm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $invoiceQty_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' AND `shipping_status_id` = '1' ORDER BY invoice.id DESC");

                            $image_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `p_images` ON invoice.product_id = p_images.product_id WHERE invoice.user_email = '" . $_SESSION["u"]["email"] . "' AND `shipping_status_id` = '1' ORDER BY invoice.id DESC");



                            for ($x = 0; $x < $oders_num; $x++) {
                                $oder_data = $orders_rs->fetch_assoc();
                                $invoiceQty_Data = $invoiceQty_rs->fetch_assoc();
                                $image_data = $image_rs->fetch_assoc();
                                $subTotal = ($oder_data["price"]) * ($invoiceQty_Data["qty"]);
                                $shipping = $oder_data["delivary_fee"];
                                $grandTotal = $subTotal + $shipping;

                            ?>
                                <tr>
                                    <td valign="middle"><a href="<?php echo "singleProductView.php?id=" . ($invoiceQty_Data["product_id"]) ?>"><img src="<?php echo $image_data["code"]; ?>" width="70" alt=""></a></td>

                                    <td class=" text-black text-center align-middle"><?php echo $oder_data["title"]; ?> </td>
                                    <td class="text-center align-middle">LKR <?php echo number_format($oder_data["price"], 2, '.', ','); ?></td>
                                    <td class="text-center align-middle"><?php echo $invoiceQty_Data["qty"]; ?></td>
                                    <td class="text-right align-middle">LKR <?php echo number_format($grandTotal, 2, '.', ','); ?></td>

                                    <td class="text-right align-middle"><Button class=" btn btn-primary" onclick="confirmOder();">Confirm Oder</Button></td>


                                    <input type="hidden" id="p_id" value="<?php echo $invoiceQty_Data["product_id"]; ?>">
                                    <input type="hidden" id="o_id" value="<?php echo $invoiceQty_Data["order_id"]; ?>">
                                    <input type="hidden" id="u_id" value="<?php echo $invoiceQty_Data["user_email"]; ?>">
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="orderconfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Received</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Thank you for confirming that you've received your order from Cloud Store!</p>

                                                <input class=" form-control" type="text" id="fb" placeholder=" Write a review !!!">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="saveFeedback();">Submit feedback</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
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