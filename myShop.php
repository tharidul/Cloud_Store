<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bttn.css" />
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">
    <div class=" container-fluid">
        <div class="row min-vh-100">
            <?php include "header.php" ?>

            <div class="col-12 ">
                <div class="row">
                    <label class=" fw-bold fs-2 text-center">My Shop</label>
                </div>
                <div>
                    <hr>
                </div>
            </div>


            <?php

            require "connction.php";

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];

                $data = $_SESSION["u"];
                $c_rs = Database::search("SELECT * FROM `city`");
                $d_rs = Database::search("SELECT * FROM `district`");

                $seller_rs = Database::search("SELECT * FROM `shop` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");

                $seller_num = $seller_rs->num_rows;

                if ($seller_num == 1) {
            ?>
                    <div class="col-12 mb-3 mt-2">
                        <div class="row">
                            <div class=" col-lg-6 col-12 ">
                                <?php
                                $shop_rs = Database::search("SELECT * FROM `shop` WHERE `user_email`='" . $email . "'");
                                $shop_data = $shop_rs->fetch_assoc();
                                ?>
                                <label class="fw-bold fs-4"><i class="bi bi-shop fs-5"></i> &nbsp; <?php echo $shop_data["shop_name"]; ?></label>

                            </div>
                            <div class="col-lg-6 col-12 text-end">
                                <?php
                                if ($shop_data["shop_status_id"] == 1) {
                                ?>
                                    <a href="addProduct.php" class=" btn btn-primary text-decoration-none">Add New Product</a>
                                    <a href="ViewOrders.php" class=" btn btn-dark text-decoration-none text-white">View New Orders</a>
                                <?php
                                } else if ($shop_data["shop_status_id"] == 2) {
                                ?>
                                    <label class="fw-bold fs-5 text-info"> &nbsp; <span class="text-dark">Status</span> : Pending </label>
                                <?php
                                } else {
                                ?>
                                    <label class="fw-bold fs-5 text-danger"> &nbsp; <span class="text-dark">Status</span> : Blocked </label>
                                <?php
                                }
                                ?>


                            </div>


                        </div>
                    </div>
                    <hr>


                    <!-- Product Section -->
                    <?php
                    if ($shop_data["shop_status_id"] == 1) {
                        $count_rs = Database::search("SELECT * FROM `shop` 
                    INNER JOIN `product`ON `product`.`shop_sid` = `shop`.`sid` WHERE `shop_sid` = '" . $shop_data["sid"] . "' ");
                        $count_num = $count_rs->num_rows;

                        if ($count_num >= 1) {
                    ?>
                            <div class=" col-12">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <label class=" fw-bold fs-4">Product Manage</label>
                                    </div>

                                    <div class="row" id="sort">
                                        <div class="col-12 ">
                                            <div class="row gap-4 justify-content-center">

                                                <?php

                                                if (isset($_GET["page"])) {

                                                    $pageno = $_GET["page"];
                                                } else {
                                                    $pageno = 1;
                                                }

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $email . "'");
                                                $product_num = $product_rs->num_rows;

                                                $results_per_page = 8;

                                                $number_of_pages = ceil($product_num / $results_per_page);

                                                $page_results = ($pageno - 1) * $results_per_page;

                                                $selected_Rs = Database::search("SELECT * FROM `product` WHERE `user_email` ='" . $email . "' 
                                LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                                $selected_num = $selected_Rs->num_rows;

                                                for ($x = 0; $x < $selected_num; $x++) {

                                                    $selected_data = $selected_Rs->fetch_assoc();

                                                ?>
                                                    <!-- Card -->

                                                    <div class=" card mb-3 mt-3 col-12 col-lg-2">

                                                        <?php
                                                        $p_image_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id` ='" . $selected_data["id"] . "'");
                                                        $p_image_data = $p_image_rs->fetch_assoc();
                                                        ?>
                                                        <img src="<?php echo $p_image_data["code"]; ?>" class="card-img-top" alt="...">
                                                        <div class="card-body">
                                                            <h6 class="card-title" style="white-space: nowrap;"><?php echo substr($selected_data["title"], 0, 17); ?></h6>
                                                            <div class="form-check form-switch mb-2">
                                                                <?php
                                                                // Generate unique ID for each checkbox based on product ID
                                                                $checkbox_id = "productStates_" . $selected_data['id'];
                                                                ?>
                                                                <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $checkbox_id; ?>" <?php echo $selected_data["status_id"] == 1 ? 'checked' : ''; ?> onchange="changeProductStates(<?php echo $selected_data['id']; ?>);">
                                                                <a href='<?php echo "updateProduct.php?pid=" . $selected_data["id"]; ?>' type="button" class="btn btn-warning btn-sm">Update Product</a>
                                                            </div>


                                                        </div>
                                                        <div class="card-footer">
                                                            <small class="text-muted">Qty :<?php echo $selected_data["qty"]; ?></small>
                                                        </div>

                                                    </div>

                                                    <!-- Card -->
                                                <?php
                                                }


                                                ?>

                                            </div>
                                        </div>
                                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-lg justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                        echo "#";
                                                                                    } else {
                                                                                        echo "?page=" . ($pageno - 1);
                                                                                    } ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <?php

                                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                                        if ($x == $pageno) {
                                                    ?>
                                                            <li class="page-item active ">
                                                                <a class="page-link" href="<?php echo "?page=" . $x;  ?>"><?php echo $x; ?></a>
                                                            </li>
                                                        <?php
                                                        } else {

                                                        ?>
                                                            <li class="page-item bg-primary ">
                                                                <a class="page-link" href="<?php echo "?page=" . $x;  ?>"><?php echo $x; ?></a>
                                                            </li>
                                                    <?php

                                                        }
                                                    }

                                                    ?>

                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                        echo "#";
                                                                                    } else {
                                                                                        echo "?page=" . ($pageno + 1);
                                                                                    } ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        <?php
                        } else {

                        ?>
                            <div class="col-12 p-5">
                                <div class="row justify-content-center">
                                    <img src="resource/empty-box.png" style="width: 20%;" />
                                </div>

                            </div>
                        <?php
                        }
                        ?>

                    <?php
                    } else {
                    ?>
                        <div class="col-12 p-5">
                            <div class="row justify-content-center">
                                <img src="resource/empty-box.png" style="width: 20%;" />
                            </div>

                        </div>
                    <?php
                    }
                    ?>
                    <!-- Product Section -->

                <?php
                } else {

                ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 d-none d-lg-block text-center p-3">

                                <img src="resource/shop.jpg" class=" img-fluid" style="scale:0.9;">

                            </div>
                            <div class="col-12 col-lg-6">
                                <label class=" fs-3 mb-3">Create your Seller Account</label>
                                <div class="row g-3 justify-content-center">


                                    <div class=" col-12">
                                        <label class=" form-label text-black-50 fs-6">Shop Name</label>
                                        <input type="text" class=" form-control form-control-sm" id="sname">
                                    </div>

                                    <div class=" col-12">
                                        <label class=" form-label text-black-50 fs-6">Bussiness Registration Number</label>
                                        <input type="text" class=" form-control form-control-sm" id="rnumber">
                                    </div>

                                    <div class=" col-12 ">
                                        <label class=" form-label text-black-50 fs-6 ">Email</label>
                                        <input type="email" class=" form-control form-control-sm" value="<?php echo $data["email"]; ?>" disabled>
                                    </div>

                                    <div class=" col-12 ">
                                        <label class=" form-label text-black-50 fs-6 ">Mobile (Shop)</label>
                                        <input type="text" class=" form-control form-control-sm" id="smobile">
                                    </div>

                                    <div class=" col-12 ">
                                        <label class=" form-label text-black-50 fs-6 ">Address Line 1 (Shop)</label>
                                        <input type="text" class=" form-control form-control-sm" id="sline1">
                                    </div>

                                    <div class=" col-12 ">
                                        <label class=" form-label text-black-50 fs-6 ">Address Line 2 (Shop)</label>
                                        <input type="text" class=" form-control form-control-sm" id="sline2">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-black-50 fs-6 mt-2">City</label>
                                        <select class="form-select form-select-sm" id="scity">
                                            <option value="0">Select City</option>
                                            <?php
                                            $c_num = $c_rs->num_rows;
                                            for ($x = 0; $x < $c_num; $x++) {
                                                $cdata = $c_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cdata["id"]; ?>"><?php echo $cdata["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <script>
                                        // Get the select element
                                        var select = document.getElementById("scity");

                                        // Add an event listener to the select element
                                        select.addEventListener("input", function() {
                                            // Get the value of the select element
                                            var searchValue = this.value.toLowerCase();
                                            // Loop through the options of the select element
                                            for (var i = 0; i < this.options.length; i++) {
                                                var optionValue = this.options[i].text.toLowerCase();
                                                // If the option contains the search value, select it and break the loop
                                                if (optionValue.includes(searchValue)) {
                                                    this.selectedIndex = i;
                                                    break;
                                                }
                                            }
                                        });
                                    </script>




                                    <div class="col-12 col-lg-6">
                                        <label class="form-label text-black-50 fs-6 mt-2">District</label>
                                        <select class="form-select form-select-sm" id="sdistrict">
                                            <option value="0">Select District</option>
                                            <?php
                                            $d_num = $d_rs->num_rows;
                                            for ($x = 0; $x < $d_num; $x++) {
                                                $ddata = $d_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $ddata["id"]; ?>"><?php echo $ddata["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <script>
                                        var select = document.getElementById("sdistrict");


                                        select.addEventListener("input", function() {

                                            var searchValue = this.value.toLowerCase();

                                            for (var i = 0; i < this.options.length; i++) {
                                                var optionValue = this.options[i].text.toLowerCase();

                                                if (optionValue.includes(searchValue)) {
                                                    this.selectedIndex = i;
                                                    break;
                                                }
                                            }
                                        });
                                    </script>


                                    <div class="col-9 col-lg-4 mt-4 mb-4">
                                        <button class="btn btn-primary" onclick="createSeller();">Create Seller Account</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                }

                ?>


                <!-- if -->

                <!-- if -->

                <!-- else -->
                <hr>


                <!-- else -->
            <?php

            } else {
                header("Location:home.php");
            }


            ?>


            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>