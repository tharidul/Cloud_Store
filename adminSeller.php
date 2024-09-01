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
        <title>Admin Sellers| Cloud Store</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" href="resource/logo.png" />
    </head>

    <body class="back">

        <div class=" container-fluid">
            <div class="row min-vh-100">

                <?php include "adminheader.php"; ?>

                <div class="col-12">
                    <div class="row">
                        <div class=" col-12">
                            <div class="row justify-content-center">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                        <div class="col-3  d-grid">
                                            <button class="nav-link text-dark active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Cloud Store Sellers</button>
                                        </div>

                                        <div class="col-3 d-grid">
                                            <button class="nav-link text-dark" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Seller Request</button>
                                        </div>

                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="col-12 p-3">

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-4">
                                                        <input type="text" class=" form-control">
                                                    </div>

                                                    <div class="col-2">
                                                        <Button class=" btn btn-dark">Search</Button>
                                                    </div>
                                                </div>

                                                <div class="row mt-5">

                                                    <?php
                                                    $seller_count_rs = Database::search("SELECT * FROM `shop` WHERE `shop_status_id` = '1' OR `shop_status_id` = '3'");
                                                    $seller_count = $seller_count_rs->num_rows;

                                                    if ($seller_count == 0) {

                                                    ?>
                                                        <div>

                                                            <div class="col-12">
                                                                <div class="row justify-content-center">
                                                                    <img src="resource/sellerReq.jpg" style="width: 30%;" />
                                                                </div>
                                                                <h3 class=" text-center">No Sellers Yet !!!</h3>
                                                            </div>

                                                        </div>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <table class="table  table-hover table-dark table-responsive-sm ">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Owner</th>
                                                                    <th scope="col">Shop Name</th>
                                                                    <th scope="col">Bussiness Register Number</th>
                                                                    <th scope="col">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $seller_rs = Database::search("SELECT * FROM `shop` INNER JOIN `user` ON user.email = shop.user_email WHERE `shop_status_id` = '1' OR `shop_status_id` = '3'");
                                                                $seller_num = $seller_rs->num_rows;
                                                                for ($x = 0; $x < $seller_num; $x++) {
                                                                    $seller_data = $seller_rs->fetch_assoc();

                                                                ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $seller_data["sid"]; ?></th>
                                                                        <td><?php echo $seller_data["user_email"]; ?></td>
                                                                        <td><?php echo $seller_data["fname"]; ?> <?php echo $seller_data["lname"]; ?></td>
                                                                        <td><?php echo $seller_data["shop_name"]; ?></td>
                                                                        <td><?php echo $seller_data["r_number"]; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if($seller_data["shop_status_id"] == "1"){
                                                                                ?>
                                                                                <button class=" btn btn-danger" onclick="blockSeller(<?php echo $seller_data['sid'] ?>);"><i class="bi bi-x-circle"></i></button>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                <button class=" btn btn-success" onclick="unBlockSeller(<?php echo $seller_data['sid'] ?>);"><i class="bi bi-check-circle"></i></i></button>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>

                                                                <?php
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>
                                                    <?php
                                                    }
                                                    ?>



                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="col-12 p-3">
                                            <?php
                                            $sCont_rs = Database::search("SELECT * FROM `shop` WHERE `shop_status_id` = '2'");
                                            $shop_count = $sCont_rs->num_rows;

                                            if ($shop_count == 0) {

                                            ?>
                                                <div>

                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <img src="resource/sellerReq.jpg" style="width: 30%;" />
                                                        </div>
                                                        <h3 class=" text-center">No Seller Request Yet !!!</h3>
                                                    </div>

                                                </div>
                                            <?php

                                            } else {
                                            ?>
                                                <table class="table table-dark table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Owner</th>
                                                            <th scope="col">Shop Name</th>
                                                            <th scope="col">Bussiness Register Number</th>
                                                            <th scope="col">Accept</th>
                                                            <th scope="col">Reject</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $shop_r_rs = Database::search("SELECT * FROM `shop` INNER JOIN `user` ON user.email = shop.user_email WHERE `shop_status_id` = '2'");
                                                        $shop_num = $shop_r_rs->num_rows;
                                                        for ($x = 0; $x < $shop_num; $x++) {
                                                            $shop_r_data = $shop_r_rs->fetch_assoc();

                                                        ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $shop_r_data["sid"]; ?></th>
                                                                <td><?php echo $shop_r_data["user_email"]; ?></td>
                                                                <td><?php echo $shop_r_data["fname"]; ?> <?php echo $shop_r_data["lname"]; ?></td>
                                                                <td><?php echo $shop_r_data["shop_name"]; ?></td>
                                                                <td><?php echo $shop_r_data["r_number"]; ?></td>
                                                                <td><button class="btn btn-primary" onclick="acceptSeller(<?php echo $shop_r_data['sid'] ?>);"><i class="bi bi-check-circle"></i></button></td>
                                                                <td><button class=" btn btn-danger" onclick="rejectSeller(<?php echo $shop_r_data['sid'] ?>);"><i class="bi bi-x-circle"></i></button></td>
                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            

                <?php include "footer.php"; ?>


            </div>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: adminSignIn.php");
}
?>