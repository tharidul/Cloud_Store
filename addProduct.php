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

                require "connction.php";

                $category_rs = Database::search("SELECT * FROM `category`");
                $brand_rs = Database::search("SELECT * FROM `brand`");
                $model_rs = Database::search("SELECT * FROM `model`");
                $color_rs = Database::search("SELECT * FROM `color`");

                $category_num = $category_rs->num_rows;
                $brand_num = $brand_rs->num_rows;
                $model_num = $model_rs->num_rows;
                $color_num = $color_rs->num_rows;

            ?>



                <div class="col-12 mb-3">
                    <div class="row">
                        <label class=" fw-bold fs-3 text-center">Add New Product</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6 border-end border-secondary">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <div class="row g-2">

                                        <div class="col-12  mb-3 mt-3">
                                            <label class=" fw-bold fs-6 mb-2">Add Product Title</label>
                                            <input type="text" class="form-control" placeholder="Product Title" id="title">
                                        </div>

                                        <div>
                                            <hr>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-3 mb-3">
                                            <label class=" fw-bold fs-6 mb-2">Select Category</label>
                                            <select class=" form-select " id="category">
                                                <option value="0">All Categories</option>
                                                <?php
                                                
                                                for($x=0;$x < $category_num;$x++){

                                                    $c_data= $category_rs->fetch_assoc();

                                                    ?>
                                                    <option value="<?php echo $c_data["id"]; ?>"><?php echo $c_data["name"]; ?></option>
                                                    <?php

                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-3 mb-3">
                                            <label class=" fw-bold fs-6 mb-2">Select Brand</label>
                                            <select class=" form-select " id="brand">
                                                <option value="0">All Brands</option>

                                                <?php
                                                 for($x=0;$x < $brand_num ;$x++){

                                                    $b_data= $brand_rs->fetch_assoc();

                                                    ?>
                                                    <option value="<?php echo $b_data["id"]; ?>"><?php echo $b_data["name"]; ?></option>
                                                    <?php

                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-3 mb-3">
                                            <label class=" fw-bold fs-6 mb-2">Select Model</label>
                                            <select class=" form-select" id="model">
                                                <option value="0">All Models</option>

                                                <?php
                                                 for($x=0;$x < $model_num ;$x++){

                                                    $m_data= $model_rs->fetch_assoc();

                                                    ?>
                                                    <option value="<?php echo $m_data["id"]; ?>"><?php echo $m_data["name"]; ?></option>
                                                    <?php

                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-3 mb-3">
                                            <label class=" fw-bold fs-6 mb-2">Select Product Color</label>
                                            <select id="color" class="a form-select">
                                                <option value="0">Colors</option>
                                                <?php
                                                
                                                for($x=0;$x < $color_num;$x++){

                                                    $clr_data= $color_rs->fetch_assoc();

                                                    ?>
                                                    <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["name"]; ?></option>
                                                    <?php

                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div>
                                            <hr>
                                        </div>

                                        <div class="col-12 mt-3 mb-3">
                                            <label class=" fw-bold fs-6 mb-2">Unit price</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" placeholder="Price" id="price">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3 mt-3">
                                            <label class=" fw-bold fs-6 mb-2">Add Quantity</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="Quantity" aria-label="Recipient's username" id="qty">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3 mt-3">
                                            <label class=" fw-bold fs-6 mb-2">Add Shipping Cost</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="Shipping Cost" aria-label="Recipient's username" id="shipping">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class=" form-label fw-bold" style="font-size:20px">Add Product Images</label>
                                        </div>
                                        <div class=" offset-lg-3 col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resource/plus.png" class=" img-fluid" id="i0">
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resource/plus.png" class=" img-fluid" id="i1">
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resource/plus.png" class=" img-fluid" id="i2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-warning" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-12 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class=" fw-bold fs-6">Add Product Description</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="des" placeholder="Product Description" id="floatingTextarea2" style="height: 100px"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3 mb-3">
                                    <div class="row justify-content-center">
                                        <div class="col-10 col-lg-5 d-grid">
                                            <button class="btn btn-primary" onclick="addProduct();">Add Product</button>
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