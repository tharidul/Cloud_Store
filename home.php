<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bttn.css" />
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">


    <div class=" custom-scrollbar container-fluid">
        <div class="row">
            <?php include "header.php"; ?>


            <style>
                .custom-scrollbar {
                    /* Set a fixed height for the container */
                    height: 100vh;

                    /* Add overflow and specify a custom scrollbar width */
                    overflow: auto;
                    scrollbar-width: thin;

                    /* Define the track color */
                    scrollbar-color: #c0c0c0 #f0f0f0;
                }

                .custom-scrollbar::-webkit-scrollbar {
                    width: 10px;
                    /* Set the width of the scrollbar */
                }

                .custom-scrollbar::-webkit-scrollbar-track {
                    background-color: #99ebff;
                    /* Define the track color */
                }

                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background-color: #57a8f9;
                    /* Define the thumb color */
                }
            </style>

            <div class="col-12  mt-3 mb-3">
                <!-- Search Bar -->
                <div class="row justify-content-center ">
                    <div class=" col-9 col-lg-6">
                        <div class="row justify-content-center">

                            <input type="text" class="input" placeholder="Search..." id="searchTitle">

                        </div>
                    </div>

                    <div class="col-3 col-lg-2  ">
                        <div class="row">
                            <div class="btn-group">
                                <button class="btnsearch" onclick="basicSearch(0);">Search</button>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-1 ">
                        <p>
                            <a class=" fs-6 text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Filter &nbsp;<i class="bi bi-caret-down-fill"></i>
                            </a>
                        </p>
                    </div>

                </div>
                <!-- Search Bar -->

                <style>
                    .input {
                        border: none;
                        height: 40px;
                        border-radius: 1rem;
                        background: #ffffff;
                        box-shadow: 5px 5px 10px #c5c5c5,
                            -20px -20px 60px #ffffff;
                        transition: 0.3s;
                    }

                    .input:focus {
                        outline-color: #2179fc;
                        background: #eef9fb;
                        box-shadow: inset 20px 20px 60px #ffffff,
                            inset -20px -20px 60px #ffffff;
                        transition: 0.3s;
                    }


                    button.btnsearch {
                        height: 40px;
                        width: auto;
                        padding: 10px 40px;
                        border-radius: 50px;
                        border: 0;
                        background-color: white;
                        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
                        letter-spacing: 1.5px;
                        text-transform: uppercase;
                        font-size: 15px;
                        transition: all .5s ease;
                    }

                    button.btnsearch:hover {
                        letter-spacing: 3px;
                        background-color: hsl(220deg 92% 48%);
                        color: hsl(0, 0%, 100%);
                        box-shadow: rgb(9 84 235) 0px 7px 29px 0px;
                    }

                    button.btnsearch:active {

                        background-color: hsl(220deg 92% 48%);
                        color: hsl(0, 0%, 100%);
                        box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
                        transform: translateY(10px);
                        transition: 100ms;
                    }

                    .cyberpunk-button {
                        background-color: #30cfd0;
                        color: #fff;
                        font-size: 18px;
                        border: none;
                        border-radius: 5px;
                        padding: 15px 25px;
                        cursor: pointer;
                        transition: all 0.3s ease-in-out;
                    }

                    .cyberpunk-checkbox {
                        appearance: none;
                        width: 20px;
                        height: 20px;
                        border: 2px solid #30cfd0;
                        border-radius: 5px;
                        background-color: transparent;
                        display: inline-block;
                        position: relative;
                        margin-right: 10px;
                        cursor: pointer;
                    }

                    .cyberpunk-checkbox:before {
                        content: "";
                        background-color: #30cfd0;
                        display: block;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%) scale(0);
                        width: 10px;
                        height: 10px;
                        border-radius: 3px;
                        transition: all 0.3s ease-in-out;
                    }

                    .cyberpunk-checkbox:checked:before {
                        transform: translate(-50%, -50%) scale(1);
                    }

                    .cyberpunk-checkbox-label {
                        font-size: 18px;
                        color: black;
                        cursor: pointer;
                        user-select: none;
                        display: flex;
                        align-items: center;
                    }
                </style>


                <!-- Filter Bar -->
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




                                            <label class="cyberpunk-checkbox-label">
                                                <input class="cyberpunk-checkbox" type="checkbox" value="free-shipping" id="freeShipping" onchange="basicSearch(0);">
                                                Free Shipping</label>


                                        </div>

                                        <div class="col-12 col-lg-2">
                                            <select class=" form-select" id="cid" onchange="load_brand(); basicSearch(0);">

                                                <option value="0" selected>Category</option>

                                                <?php
                                                require "connction.php";
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
                <!-- Filter Bar -->

            </div>

            <!-- Head -->

            <!-- Body -->

            <div class=" container" id="basicSearchResult">

                <!-- slider -->
                <div class=" container mt-5 ">
                    <div class="row justify-content-center">

                        <div class="row">
                            <div id="carouselExampleFade" class="carousel carousel-dark slid" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resource/ads/01.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/ads/02.png" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/ads/03.png" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider -->

                <!-- Description -->

                <style>
                    body,
                    html {
                        height: 100%;
                        margin: 0;
                        padding: 0;
                    }

                    #scroll-section {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        min-height: 60vh;
                        opacity: 0;
                        transition: opacity 1s ease;
                    }

                    #scroll-section.visible {
                        opacity: 1;
                    }
                </style>

                <section class=" mt-5 mb-5">
                    <div class="row p-3" style="background: linear-gradient(90deg, rgba(0,173,235,1) 32%, rgba(154,226,254,1) 70%);">
                        <div class="col-12 col-lg-8 d-flex justify-content-center align-items-center" >
                            <p class=" text-white  fsp">
                                Welcome to Cloud Store, the ultimate destination for all your electronic needs.
                                Whether you're a gourmet registered seller or a tech enthusiast, our website offers a seamless experience for both buying and selling.
                                As a gourmet registered seller, you can create your own online store within our marketplace, while tech enthusiasts can explore a wide range of cutting-edge gadgets.
                                With a user-friendly interface, secure transactions, and a vast product collection, Cloud Store ensures a convenient and reliable platform for all.
                                Discover the latest in electronics and unlock endless possibilities with Cloud Store today.
                            </p>
                        </div>

                        <style>
                            .text-white {
                                color: white;
                            }

                            @media (max-width: 767px) {
                                .fsp {
                                    font-size: 0.7rem;
                                    /* Smaller font size for small screens */
                                }
                            }

                            @media (min-width: 768px) and (max-width: 991px) {
                                .fsp {
                                    font-size: 1rem;
                                    /* Font size for medium-sized screens */
                                }
                            }

                            @media (min-width: 992px) {
                                .fsp {
                                    font-size: 1.5rem;
                                    /* Larger font size for large screens */
                                }
                            }
                        </style>
                        <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center">
                            <img src="resource/home_shop.png" class=" img-fluid" >
                        </div>
                    </div>
                </section>





                <div class="col-12 mb-3 text-center ">
                    <span class=" fs-2 fw-bold ">Best Products</span>
                </div>

                <div class="col-12 mt-3 mb-3" style="border-radius:20px;background:#daebff">
                    <div class="row justify-content-center">
                        <?php
                        $p_rs = Database::search("SELECT * FROM `product` INNER JOIN `p_images` ON product.id = p_images.product_id LIMIT 18");
                        $p_num = $p_rs->num_rows;

                        for ($y = 0; $y < $p_num; $y++) {
                            $pdata = $p_rs->fetch_assoc();
                        ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="card cardHome my-3" style="width: 90%;">
                                        <a href="<?php echo "singleProductView.php?id=" . ($pdata["id"]) ?>">
                                            <img src="<?php echo $pdata["code"]; ?>" class="card-img-top">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-size:15px;"><?php echo $pdata["title"]; ?></h5>
                                            <p class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>



                <hr>

                <div class="col-12 mb-3  text-center">
                    <span class=" fs-2 fw-bold ">All Categories</span>
                </div>

                <!-- Cetegory -->

                <div class=" col-12 mt-3 mb-3" style="border-radius:20px;background:#daebff">
                    <div class="row justify-content-center">

                        <?php
                        $c_rs = Database::search("SELECT * FROM `category`");
                        $c_num = $c_rs->num_rows;

                        for ($y = 0; $y < $category_num; $y++) {
                            $cdata = $c_rs->fetch_assoc();
                        ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <div class="card cardHome my-3" style="width: 90%;border-radius:20px;">
                                        <a href="<?php echo "singleCategoryView.php?id=" . ($cdata["id"]) ?>">
                                            <img src="<?php echo $cdata["c_image"]; ?>" class="card-img-top" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                        </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title" style="font-size:15px;"><?php echo $cdata["name"]; ?></h5>
                                            <p class="card-text"></p>
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
            <!-- Catedoty -->

            <!-- Body -->

            <?php include "footer.php"; ?>
        </div>

    </div>


    <script src="script.js"></script>
    <script src="wow.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script>
        AOS.init({});
    </script>
</body>

</html>