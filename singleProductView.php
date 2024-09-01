<?php
if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    require "connction.php";

?>

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
        <link rel="stylesheet" href="bttn.css" />
        <link rel="icon" href="resource/logo.png" />
    </head>

    <body class="back">
        <div class=" container-fluid">
            <div class="row">
                <?php include "header.php" ?>

                <div class="col-12  mt-3 mb-3">
                    <div class="row justify-content-center ">

                        <div class=" col-9 col-lg-6">
                            <div class="row justify-content-center">

                                <input type="text" class="form-control" placeholder="Search..." id="searchTitle">

                            </div>
                        </div>

                        <div class="col-3 col-lg-1  d-grid">
                            <div class="row">
                                <div class="btn-group">
                                    <button class="btn bttn-unite bttn-md bttn-primary" onclick="basicSearch(0);">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-1 d-grid">
                            <p>
                                <a class=" fs-6 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Filter &nbsp;<i class="bi bi-caret-down-fill"></i>
                                </a>
                            </p>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-10 ">
                                <div class="row text-center">

                                    <div class="collapse mt-2" id="collapseExample">

                                        <div class="row">
                                            <div class=" col-12 col-lg-4">

                                                <label for="price-range">Price Range:</label><span class=" offset-1" id="price-display">LKR 1,000,000.00</span>
                                                <input type="range" id="price-range" name="price-range" min="1000" max="1000000" style="width: 100%;" value="1000000" onchange="basicSearch(0);">
                                                <br>


                                                <script>
                                                    const priceRange = document.getElementById('price-range');
                                                    const displayElement = document.getElementById('price-display');

                                                    priceRange.addEventListener('input', () => {
                                                        const price = parseInt(priceRange.value);
                                                        const formattedPrice = price.toLocaleString('en-LK', {
                                                            style: 'currency',
                                                            currency: 'LKR'
                                                        });
                                                        displayElement.textContent = formattedPrice;
                                                    });
                                                </script>

                                            </div>

                                            <div class="col-12 col-lg-2">

                                                <div class="form-check">
                                                    <input class="form-check-input " type="checkbox" value="free-shipping" id="freeShipping" onchange="basicSearch(0);">
                                                    <label class="form-check-label" for="freeShipping">
                                                        Free Shipping
                                                    </label>
                                                </div>

                                            </div>

                                            <div class="col-12 col-lg-2">
                                                <select class=" form-select" id="cid" onchange="load_brand(); basicSearch(0);">

                                                    <option value="0" selected>Category</option>

                                                    <?php

                                                    $category_rs = Database::search("SELECT * FROM `category`");
                                                    $category_num = $category_rs->num_rows;


                                                    for ($x = 0; $x < $category_num; $x++) {

                                                        $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-2">
                                                <select class="form-select" id="brand" onchange="basicSearch(0);">
                                                    <option value="0">Brand</option>
                                                    <?php
                                                    $color_rs = Database::search("SELECT * FROM `brand`");
                                                    for ($x = 0; $x < $color_rs->num_rows; $x++) {
                                                        $c_data = $color_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $c_data["id"] ?>"><?php echo $c_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-2">

                                                <button class=" btn btn-link" onclick="clearFilters();">Clear Filter</button>

                                                <script>
                                                    function clearFilters() {
                                                        document.getElementById("searchTitle").value = "";
                                                        document.getElementById("price-range").value = 1000000;
                                                        document.getElementById("price-display").textContent = "LKR 1,000,000.00";
                                                        document.getElementById("freeShipping").checked = false;
                                                        document.getElementById("cid").selectedIndex = 0;
                                                        document.getElementById("brand").selectedIndex = 0;
                                                        basicSearch(0);
                                                    }
                                                </script>

                                            </div>


                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mb-3" id="basicSearchResult">
                    <div class="row">


                        <div class="col-12 shadow-lg">
                            <div class="row">
                                <div class="col-12 p-4">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-3">
                                            <div class="row">
                                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner">
                                                        <?php

                                                        $image_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id`='" . $pid . "'");
                                                        $image_num = $image_rs->num_rows;
                                                        $img = array();

                                                        if ($image_num != 0) {

                                                            for ($x = 0; $x < $image_num; $x++) {
                                                                $image_data = $image_rs->fetch_assoc();
                                                                $img[$x] = $image_data["code"];
                                                        ?>
                                                                <div class="carousel-item active">
                                                                    <img src="<?php echo $image_data["code"] ?>" class="d-block w-100" alt="...">
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="carousel-item">
                                                                <img src="resource/product_img/13pro.png" class="d-block w-100" alt="...">
                                                            </div>
                                                        <?php
                                                        }

                                                        ?>


                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `color` ON color.id = product.color_id WHERE product.id = '" . $pid . "' ");
                                        $product_data = $product_rs->fetch_assoc();

                                        ?>

                                        <div class="col-12 col-lg-5 border-end border-secondary">
                                            <div class="row justify-content-center">
                                                <label class="fw bold fs-4"><?php echo $product_data["title"]; ?></label>

                                                <div class="col-12">
                                                    <label class=" fw-bold fs-3 mt-3 ">LKR.<?php echo number_format($product_data["price"], 2); ?></label>
                                                </div>

                                                <hr>

                                                <div class="col-12 mb-3">
                                                    <span class="fw-bold">Stock :</span>&nbsp; &nbsp;<span><?php echo $product_data["qty"]; ?> items left</span>
                                                    <span class="fw-bold offset-1">Color :</span>&nbsp; &nbsp;<span><?php echo $product_data["name"]; ?></span>
                                                </div>

                                                <hr>

                                                <div class="col-12 d-grid">
                                                    <p>
                                                        <a class=" fs-6 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                            Product Details &nbsp;<i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </p>
                                                    <div class="collapse" id="collapseExample">
                                                        <div class="card card-body">
                                                            <p>
                                                                <?php
                                                                $description = $product_data["description"]; // get the CPU specifications from the database
                                                                $lines = explode("\n", $description); // split the description into an array of lines using the newline character as the delimiter

                                                                // loop through the lines and output them within HTML tags
                                                                foreach ($lines as $line) {
                                                                    echo "<li>" . $line . "</li>";
                                                                }
                                                                ?>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <div class="col-8">

                                                        <div class="input-group input-group-sm mb-3 ">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Qty</span>
                                                            <input type="number" min="1" value="1" class="form-control" id="qty">
                                                        </div>
                                                    </div>

                                                    <div class="col-4 text-center mb-3" >
                                                        <i class=" text-danger fs-4 bi bi-bag-heart" onclick="addtoWatchlist(<?php echo $_GET['id'] ?>);"></i>
                                                    </div>
                                                </div>

                                                <hr>



                                                <?php
                                                if ($product_data["qty"] > 0) {
                                                ?>
                                                    <div class="col-11 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-6 d-grid">
                                                                <button class=" bttn-slant bttn-md bttn-primary" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid ?>);">BUY NOW</button>
                                                            </div>
                                                            <div class="col-6 d-grid">
                                                                <button class="bttn-slant bttn-md bttn-warning" onclick="addToCart(<?php echo $_GET['id']; ?>);">ADD TO CART</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-11 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-6 d-grid">
                                                                <button class=" bttn-slant bttn-md bttn-primary disabled">BUY NOW</button>
                                                            </div>
                                                            <div class="col-6 d-grid">
                                                                <button class="bttn-slant bttn-md bttn-warning disabled">ADD TO CART</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3 ">
                                            <div class="row">
                                                <label class=" text-secondary fs-6 mb-1"><i class="bi bi-truck"></i> Delivary :</label>

                                                <div class="col-12 mb-3">
                                                    <?php
                                                    $shop_rs = Database::search("SELECT * FROM `shop` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                                    $shop_data = $shop_rs->fetch_assoc();
                                                    ?>
                                                    <span class="fw-bold">Seller :</span><span class="offset-3"><?php echo $shop_data["shop_name"]  ?></span>
                                                </div>

                                                <hr>

                                                <div class="col-12">
                                                    <?php if ($product_data["delivary_fee"] == 0) : ?>
                                                        <span class="text-secondary mb-2">Standard Delivery</span><span class="fw-bold offset-1">Free</span>
                                                    <?php else : ?>
                                                        <span class="text-secondary mb-2">Standard Delivery</span><span class="fw-bold offset-1">Rs. <?php echo $product_data["delivary_fee"]; ?></span>
                                                    <?php endif; ?>


                                                    <p class="mt-3" style="font-size: 16px;">Enjoy free shipping promotion with minimum spend of Rs. 25,000.</p>
                                                </div>

                                                <hr>

                                                <div class="col-12 mb-2">
                                                    <label class="fw-bold fs-6 mb-1 text-success"><i class=" text-success bi bi-cash-coin"></i>&nbsp;Cash on Delivery Available</label>
                                                </div>

                                                <hr>

                                                <div class="col-12 mb-2">
                                                    <label class="fw bold text-secondary fs-6 mb-1"><i class="bi bi-people"></i> Services :</label>
                                                </div>

                                                <div class="col-12">
                                                    <p><i class="bi bi-safe"></i> &nbsp;100% Money Back Guarantee</p>
                                                </div>

                                                <div class="col-12 mb-2">
                                                    <p><i class="bi bi-calendar-day-fill"></i> &nbsp;14 Days Returns</p>
                                                </div>

                                                <hr>




                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="col-12 mb-4 mt-3">
                        <?php
                        $fb_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON user.email = feedback.user_email 
                        INNER JOIN `profile_image` ON user.email = profile_image.user_email WHERE `product_id` = '" . $pid . "' LIMIT 10");

                        $fb_num = $fb_rs->num_rows;
                        ?>
                        <label class="  fw-bold"> Customer Reviews (<?php echo $fb_num ?>)</label>
                    </div>


                    <div class="row">
                        <?php


                        for ($i = 0; $i < $fb_num; $i++) {
                            $fb_data = $fb_rs->fetch_assoc();
                        ?>

                            <div class="col-12 mb-1">
                                <div class="row">
                                    <div class=" col-1">
                                        <style>
                                            .circular-image {
                                                width: 60px;
                                                height: 60px;
                                                object-fit: cover;
                                                object-position: center;
                                                border-radius: 50%;
                                            }
                                        </style>

                                        <div style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden;">
                                            <img class="circular-image" src="<?php echo $fb_data["path"] ?>" alt="your image">
                                        </div>

                                    </div>
                                    <div class="col-11">
                                        <label class=" fw-bold">
                                            <?php echo $fb_data["fname"] ?> <?php echo $fb_data["lname"] ?><br>
                                        </label>

                                        <p>
                                            <small class="text-body-secondary"><?php echo $fb_data["review"]; ?></small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                        <?php
                        }

                        ?>

                    </div>


                </div>
                <?php include "footer.php" ?>
            </div>
        </div>



        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


    </body>

    </html>
<?php

} else {
    echo ("Something went Wrong");
}
?>