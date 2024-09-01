<?php
require "connction.php";
if (isset($_GET["id"])) {

    $cid = $_GET["id"];

    $cname_rs = Database::search("SELECT * FROM `category` WHERE category.id = '" . $cid . "' ");

    $c_num = $cname_rs->num_rows;

    if ($c_num == 1) {
        $c_data = $cname_rs->fetch_assoc();
    } else {
        echo ("Something went Wroeng");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $c_data["name"]; ?> | Cloud Store</title>
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
                                                    $cs_data = $color_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $cs_data["id"] ?>"><?php echo $c_data["name"] ?></option>
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
                    <div class="col-lg-2 d-none d-lg-block">

                        <ul class="list-group list-group-flush">
                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {

                                $category_data = $category_rs->fetch_assoc();

                            ?>

                                <a href="<?php echo "singleCategoryView.php?id=" . ($category_data["id"]) ?>" class=" text-decoration-none">
                                    <li class="list-group-item cardHome" value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["icons"]; ?> &nbsp; &nbsp;<?php echo $category_data["name"]; ?></li>
                                </a>

                            <?php
                            }
                            ?>

                        </ul>
                    </div>
                    <div class=" col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <label class="fw-bold fs-3"><?php echo $c_data["name"]; ?></label>
                            </div>

                            <hr>

                            <div class="col-12 mt-1">
                                <div class="row">

                                    <?php

                                    $p_rs = Database::search("SELECT * FROM `product` INNER JOIN `shop` ON shop.sid = product.shop_sid  WHERE `category_id` ='" . $cid . "' AND  shop_status_id = '1'");
                                    $p_num = $p_rs->num_rows;


                                    for ($x = 0; $x < $p_num; $x++) {
                                        $p_data = $p_rs->fetch_assoc();

                                        $pimg_rs = Database::search("SELECT * FROM `p_images` WHERE `product_id`= '" . $p_data["id"] . "' ");
                                        $pimg_data = $pimg_rs->fetch_assoc();

                                    ?>
                                        <div class="col-12 mt-3 mb-3 col-lg-2">

                                            <div class="card shadow cardHome">
                                                <a href='<?php echo "singleProductView.php?id=" . $p_data["id"]; ?>'>
                                                    <img src="<?php echo $pimg_data["code"]; ?>" class="card-img-top" alt="...">
                                                </a>

                                                <div class="card-body">
                                                    <h6 class="card-title" style="white-space: nowrap;"><?php echo substr($p_data["title"], 0, 17); ?></h6>
                                                    <h6 class="card-title">
                                                        LKR <b><?php echo number_format($p_data["price"]); ?></b>
                                                        <i class="text-danger fs-4 bi bi-bag-heart" onclick="addtoWatchlist(<?php echo $p_data['id'] ?>);"></i>
                                                    </h6>
                                                </div>
                                            </div>

                                           

                                        </div>

                                        

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <?php include "footer.php" ?>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>