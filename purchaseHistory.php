<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.png" />
    <link rel="stylesheet" href="bttn.css" />
</head>

<body class="back">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <?php include "header.php" ?>

            <div class="col-12 mb-3">
                <div class="row">
                    <label class=" fw-bold fs-3 text-center">Purchase History</label>
                </div>
            </div>


            <?php
            require "connction.php";
            if (isset($_SESSION["u"])) {


            ?>

                <div class="col-10">
                    <table class="table table-invoice border border-1">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="30%">Product</th>
                                <th class="text-center" width="20%">Cost per unit</th>
                                <th class="text-center" width="5%">QTY</th>
                                <th class="text-right" width="20%">Grand total</th>
                                <th class="text-right" width="20%">Purchase Date</th>
                                <th class="text-right" width="10%"> Clear Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON product.id = invoice.product_id WHERE invoice.user_email = '" . $_SESSION["u"]["email"] . "' AND `shipping_status_id` = '2'");
                            $oders_num = $orders_rs->num_rows;
                            $invoiceQty_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' AND `shipping_status_id` = '2'");

                            $image_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `p_images` ON invoice.product_id = p_images.product_id WHERE invoice.user_email = '" . $_SESSION["u"]["email"] . "' AND `shipping_status_id` = '2'");



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

                                    <td class=" text-black  align-middle"><?php echo $oder_data["title"]; ?> </td>
                                    <td class="text-center align-middle">LKR <?php echo number_format($oder_data["price"], 2, '.', ','); ?></td>
                                    <td class="text-center align-middle"><?php echo $invoiceQty_Data["qty"]; ?></td>
                                    <td class="text-right align-middle">LKR <?php echo number_format($grandTotal, 2, '.', ','); ?></td>
                                    <td class="text-right align-middle"><?php echo $invoiceQty_Data["date_time"];?></td>
                                    <td class=" align-middle"><Button class=" btn btn-primary" onclick="removedfromHistory();"><i class="bi bi-trash"></i></Button></td>


                                    <input type="hidden" id="p_id" value="<?php echo $invoiceQty_Data["product_id"]; ?>">
                                    <input type="hidden" id="o_id" value="<?php echo $invoiceQty_Data["order_id"]; ?>">
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
                </div>

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
                                <p>We hope that you're satisfied with your purchase.</p>
                                <p>If you have any questions or concerns, please don't hesitate to contact us.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


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
    <script src="cartPayment.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>