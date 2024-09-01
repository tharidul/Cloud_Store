<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">
    <div class=" container-fluid">
        <div class="row">
            <?php include "header.php";

            if (isset($_SESSION["u"])) {

                $pid = $_GET["pid"];

                require "connction.php";
            ?>



                <div class="col-12 mb-3">
                    <div class="row">
                        <label class=" fw-bold fs-3 text-center">Update Product</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6 border-end border-secondary">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <div class="row g-2">

                                        <div class="col-12  mb-3 mt-3">
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE product.id = '$pid'");
                                            $product = $product_rs->fetch_assoc();
                                            ?>
                                            <label class=" fw-bold fs-6 mb-2">Add Product Title</label>
                                            <input type="text" value="<?php echo $product["title"]; ?>" class="form-control" placeholder="Product Title" id="title">
                                        </div>

                                        <div>
                                            <hr>
                                        </div>

                                        <div class="col-12 mt-3 mb-3">
                                            <label class=" fw-bold fs-6 mb-2">Update Unit price</label>
                                            <div class="input-group mb-3">

                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" value="<?php echo $product["price"]; ?>" class="form-control" placeholder="Price" id="price">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3 mt-3">
                                            <label class=" fw-bold fs-6 mb-2">Update Quantity</label>
                                            <div class="input-group">
                                                <input type="number" value="<?php echo $product["qty"]; ?>" class="form-control" placeholder="Quantity" aria-label="Recipient's username" id="qty">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3 mt-3">
                                            <label class=" fw-bold fs-6 mb-2">Update Shipping Cost</label>
                                            <div class="input-group">
                                                <input type="number" value="<?php echo $product["delivary_fee"]; ?>" class="form-control" placeholder="Shipping Cost" aria-label="Recipient's username" id="shipping">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">


                                <div class="col-12 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" id="pid" value="<?php echo $pid; ?>">

                                            <label class=" fw-bold fs-6">Add Product Description</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="des" placeholder="Product Description" style="height: 300px"><?php echo $product["description"]; ?></textarea>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3 mb-3">
                                    <div class="row justify-content-center">
                                        <div class="col-10 col-lg-5 d-grid">
                                            <button class="btn btn-primary" onclick="updateProduct();">Update Product</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                echo ("Please Login First");
            }
            ?>

            <?php include "footer.php" ?>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>