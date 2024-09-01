<?php

session_start();
require "connction.php";

if (isset($_SESSION["au"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <link rel="icon" href="resource/logo.svg" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="icon" href="resource/logo.png" />
        <title>Admin Panel | NewTech Store</title>
    </head>

    <body style="background-color: #eef9fb;">

        <div class=" container-fluid">
            <div class="row">


                <?php include "adminheader.php" ?>


                <div class="col-12">
                    <div class="row">
                        <div class=" col-12 p-2">
                            <div class="row">

                                <?php
                                $account_rs = Database::search("SELECT * FROM `user`");
                                $account_num = $account_rs->num_rows;

                                $all_oders_rs = Database::search("SELECT * FROM `invoice`");
                                $all_orders_num = $all_oders_rs->num_rows;

                                $new_orders_rs = Database::search("SELECT * FROM `invoice` WHERE DATE(`date_time`) = CURDATE()");
                                $new_oders_num = $new_orders_rs->num_rows;

                                ?>

                                <div class="row">
                                    <div class=" col-lg-3 col-12 text-center ">
                                        <i class="bi bi-cart-check fs-3 text-success p-2"></i>
                                        <label class="text-black fs-5">Today Orders</label><br>
                                        <label class="text-black fw-bold fs-3"><?= $new_oders_num == 0 ? "0" : $new_oders_num ?></label>

                                    </div>

                                    <div class=" col-lg-3 col-12 text-center ">
                                        <i class="bi bi-chat-square-dots text-warning fs-3 p-2"></i>
                                        <label class="text-black fs-5">All Oders</label><br>
                                        <label class="text-black fw-bold fs-3"><?php echo $all_orders_num ?></label>
                                    </div>

                                    <?php
                                    $seller_rs = Database::search("SELECT * FROM `shop`");
                                    $seller_num = $seller_rs->num_rows;
                                    ?>

                                    <div class=" col-lg-3 col-12 text-center">
                                        <i class="bi bi-shop text-primary fs-3 p-2"></i>
                                        <label class="text-black fs-5">Total Sellers</label><br>
                                        <label class="text-black fw-bold fs-3"><?php echo $seller_num?></label>
                                    </div>

                                    <div class=" col-lg-3 col-12 text-center ">
                                        <i class="bi bi-people-fill text-danger fs-3 p-2"></i>
                                        <label class="text-black fs-5">Total Accounts</label><br>
                                        <label class="text-black fw-bold fs-3"><?php echo $account_num ?></label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div>
                                            <hr>
                                        </div>

                                        <?php
                                        $total_rs = Database::search("SELECT SUM(total) AS total_earning FROM invoice");
                                        $total_data = $total_rs->fetch_assoc();

                                        $total_value_rs = Database::search("SELECT * FROM `product`");
                                        $total_value_num = $total_value_rs->num_rows;
                                        $total_value = 0;

                                        $price_of_item = 0;

                                        for ($z = 0; $z < $total_value_num; $z++) {
                                            $total_value_data = $total_value_rs->fetch_assoc();

                                            $price_of_item = $total_value_data['price'];
                                            $qty_of_item = $total_value_data['qty'];
                                            $total_value += $price_of_item * $qty_of_item;
                                        }
                                        ?>

                                        <div class="col-lg-3 col-12 text-center">
                                            <div class="card shadow" style="width: 18rem;background-color: #68adff;">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-white fw-bold">Total Value of Products</h5>
                                                        <h5 class="card-title fw-bold">Rs.<?php echo number_format($total_value, 2); ?>
                                                    </h6>

                                                </div>
                                            </div>

                                        </div>


                                        <div class=" col-lg-3 col-12 text-center  ">
                                            <div class="card shadow" style="width: 18rem;background-color: #4ddfc2;">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-white fw-bold">Total Earning</h5>
                                                        <h5 class="card-title fw-bold ">Rs.<?php echo number_format($total_data['total_earning'], 2); ?>
                                                    </h6>

                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $earning = $total_data['total_earning'];
                                        $percent = 5;
                                        $commission = $earning * ($percent / 100);

                                        $seller_rem = $earning - $commission;

                                        ?>

                                        <div class=" col-lg-3 col-12 text-center ">
                                            <div class="card shadow" style="width: 18rem;background-color: #fec471;">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-white fw-bold ">Seller Remittances</h5>
                                                        <h5 class="card-title fw-bold ">Rs.<?php echo number_format($seller_rem, 2); ?>
                                                    </h6>

                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-lg-3 col-12 text-center ">
                                            <div class="card shadow" style="width: 18rem;background-color: #ff7387;">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-white fw-bold">Cloud Store Profit</h5>
                                                        <h5 class="card-title fw-bold ">Rs.<?php echo number_format($commission, 2); ?>
                                                    </h6>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>


                                <div class="row gap-5 justify-content-center">
                                    <div class="col-12 col-lg-4 mt-5">
                                        <label class="text-black fs-5 mb-2">Most Sold Product </label>
                                        <?php

                                        $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` 
                                                FROM `invoice` GROUP BY `product_id` ORDER BY 
                                                `value_occurence` DESC LIMIT 1");

                                        $freq_data = $freq_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $image_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                        $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product_id`='"  . $freq_data["product_id"] . "'");
                                        $qty_data = $qty_rs->fetch_assoc();

                                        ?>
                                        <div class="row justify-content-center shadow">
                                            <div class="card" style="width: 18rem;">
                                                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                                    <h6 class="card-text"><?php echo $qty_data["qty_total"]; ?> items</h6>
                                                    <h6 class="card-text"><b>Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</b></h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-7 mt-5 shadow">
                                        <label class="text-black fs-5 mb-2">Yearly Sales Overview: Total Earnings</label>
                                        <?php
                                        // Retrieve the total earning for each year
                                        $earning_rs = Database::search("SELECT YEAR(date_time) AS year, SUM(total) AS total_earning FROM invoice GROUP BY YEAR(date_time)");
                                        $earning_data = array();

                                        // Convert the earning data into a format that can be passed to the charting library
                                        while ($row = $earning_rs->fetch_assoc()) {
                                            $earning_data[] = array(
                                                "year" => $row["year"],
                                                "earning" => $row["total_earning"]
                                            );
                                        }
                                        ?>


                                        <canvas id="earning-chart" height="135"></canvas>



                                        <script>
                                            // Pass the earning data to the charting library
                                            var earningChart = new Chart(document.getElementById("earning-chart"), {
                                                type: 'bar',
                                                data: {
                                                    labels: <?php echo json_encode(array_column($earning_data, "year")); ?>,
                                                    datasets: [{
                                                        label: 'Total Earning',
                                                        data: <?php echo json_encode(array_column($earning_data, "earning")); ?>,
                                                        backgroundColor: '#4ddfc2'
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                beginAtZero: true,
                                                                callback: function(value, index, values) {
                                                                    return 'Rs.' + value.toLocaleString('en-LK', {
                                                                        maximumFractionDigits: 2
                                                                    });
                                                                }
                                                            }
                                                        }]
                                                    },
                                                    tooltips: {
                                                        callbacks: {
                                                            label: function(tooltipItem, data) {
                                                                var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                                                return 'Rs.' + value.toLocaleString('en-LK', {
                                                                    maximumFractionDigits: 2
                                                                });
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        </script>


                                    </div>

                                </div>




                                <div class="row justify-content-center">
                                    <div class="col-11 mt-5 mb-2">

                                        <label class="text-black fs-4">Last Oders :</label>
                                        <table class="table table-info shadow">
                                            <thead>
                                                <tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Order ID</th>
                                                    <th>Product</th>
                                                    <th>Customer Email</th>
                                                    <th>Qty</th>
                                                    <th class="total">Total</th>
                                                </tr>
                                                </tr>
                                            </thead>

                                            <tbody class="table-group-divider">
                                                <?php
                                                $invoice_rs = Database::search("SELECT invoice.id, invoice.order_id, product.title, invoice.user_email, invoice.qty AS invoice_qty, product.qty AS product_qty, invoice.total
                                                FROM `invoice`
                                                INNER JOIN `user` ON user.email = invoice.user_email
                                                INNER JOIN `product` ON invoice.product_id = product.id
                                                ORDER BY invoice.id DESC
                                                LIMIT 5
                                                ");

                                                for ($x = 0; $x < $invoice_rs->num_rows; $x++) {

                                                    $invoice_data = $invoice_rs->fetch_assoc();

                                                ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $invoice_data["id"] ?></td>
                                                        <td scope="row"><?php echo $invoice_data["order_id"] ?></td>
                                                        <td><?php echo $invoice_data["title"] ?></td>
                                                        <td><?php echo $invoice_data["user_email"] ?></td>
                                                        <td><?php echo $invoice_data["invoice_qty"] ?></td>
                                                        <td><?php echo $invoice_data["total"] ?></td>

                                                    </tr>

                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>


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


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

    </body>

    </html>
<?php

} else {

    header("Location: adminSignIn.php");
}

?>