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
    <link rel = "stylesheet" href="bttn.css"/>
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">
    <div class=" container-fluid">
        <div class="row">
            <?php include "header.php" ?>

            <?php

            require "connction.php";

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                gender.id=user.gender_id WHERE `email`='" . $email . "'");

                $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` ='".$email."'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_id=city.id INNER JOIN `district` ON 
                city.district_id=district.id INNER JOIN `province` ON 
                district.province_id=province.id WHERE `user_email` ='" . $email . "'");

                $data = $details_rs->fetch_assoc();
                $profile_d = $profile_rs->fetch_assoc();
                $address_d = $address_rs->fetch_assoc();

            ?>


                <div class="col-12">
                    <div class="row">
                        <label class=" fw-bold fs-3 text-center">Account Settings</label>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-12 col-lg-6 border-end border-dark mb-3 ">
                            <label class=" fw-bold fs-4">My Profile</label>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-6 ">
                                        <div class="d-flex flex-column align-items-center text-center">

                                            <?php
                                            if (empty($profile_d["path"])) {
                                            ?>
                                                <img src="resource/user.png" class="rounded mt-1 border border-1 border-secondary" style="width: 150px;" id="viewImg" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src=<?php echo $profile_d["path"]; ?> class=" rounded mt-1 border border-1 border-secondary" style="width: 150px;" id="viewImg" />
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-6 mt-4">
                                        <input type="file" class="d-none" id="profileImg" accept="image/*" />
                                        <label for="profileImg" class="btn btn-primary mt-1" onclick="changeImg();">Update Profile Image</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <label class=" form-label  text-black fs-6">First Name</label>
                                        <input type="text" class=" form-control " id="fname" value="<?php echo $data["fname"]; ?>">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label class=" form-label  text-black fs-6">Last Name</label>
                                        <input type="text" class=" form-control" id="lname" value="<?php echo $data["lname"]; ?>">
                                    </div>
                                    <div class=" col-12">
                                        <label class=" form-label text-black fs-6 mt-2">Email</label>
                                        <input type="email" class=" form-control" value="<?php echo $data["email"]; ?>" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label class=" form-label  text-black fs-6 mt-2">Password</label>
                                        <input type="password" class=" form-control" value="<?php echo $data["password"]; ?>" readonly>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class=" form-label  text-black fs-6 mt-2">Mobile</label>
                                        <input type="text" class=" form-control" value="<?php echo $data["mobile"]; ?>" id="mobile">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class=" form-label  text-black fs-6 mt-2">Gender</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $data["gender"] ?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="fw-bold fs-4">Address book</label>
                            <div class="row justify-content-center">

                                <?php

                                if (!empty($address_d["line1"])) {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label text-black fs-6">Address Line 1</label>
                                        <input type="text" id="line1" class="form-control" value="<?php echo $address_d["line1"]; ?>">
                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label text-black fs-6">Address Line 1</label>
                                        <input id="line1" type="text" class="form-control">
                                    </div>
                                <?php

                                }

                                ?>


                                <?php

                                if (!empty($address_d["line2"])) {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label text-black fs-6">Address Line 2</label>
                                        <input id="line2" type="text" class="form-control" value="<?php echo $address_d["line2"]; ?>">
                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label text-black fs-6">Address Line 2</label>
                                        <input id="line2" type="text" class="form-control">
                                    </div>
                                <?php

                                }
                                ?>
                                <?php
                                $province_rs = Database::search("SELECT * FROM `province`");
                                $district_rs = Database::search("SELECT * FROM `district`");
                                $city_rs = Database::search("SELECT * FROM `city`");
                                ?>

                                <div class="col-12 col-lg-6">
                                    <label class=" form-label  text-black fs-6 mt-2">Province</label>
                                    <select class=" form-select" id="province">
                                        <?php
                                        $province_num = $province_rs->num_rows;

                                        for ($x = 0; $x < $province_num; $x++) {

                                            $province_data = $province_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                if (!empty($address_d["province_id"])) {
                                                                                                    if ($province_data["id"] == $address_d["province_id"]) { ?>selected<?php
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                        ?>><?php echo $province_data["name"]; ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label class=" form-label  text-black fs-6 mt-2">District</label>
                                    <select class=" form-select" id="district">
                                        <?php
                                        $district_num = $district_rs->num_rows;

                                        for ($y = 0; $y < $district_num; $y++) {

                                            $district_data = $district_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                if (!empty($address_d["district_id"])) {
                                                                                                    if ($district_data["id"] == $address_d["district_id"]) { ?>selected<?php
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                        ?>><?php echo $district_data["name"]; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label class=" form-label  text-black fs-6 mt-2">City</label>
                                    <select class=" form-select" id="city">
                                        <?php
                                        $city_num = $city_rs->num_rows;

                                        for ($z = 0; $z < $city_num; $z++) {

                                            $city_data = $city_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                            if (!empty($address_d["city_id"])) {
                                                                                                if ($city_data["id"] == $address_d["city_id"]) { ?>selected<?php
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                            ?>><?php echo $city_data["name"]; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php

                                if (!empty($address_d["postal_code"])) {

                                ?>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label fs-6 text-black">Postal Code</label>
                                        <input type="text" id="pcode" class="form-control" value="<?php echo $address_d["postal_code"]; ?>">
                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label class="form-label fs-6 text-black">Postal Code</label>
                                        <input type="text" id="pcode" class="form-control">
                                    </div>
                                <?php

                                }
                                ?>

                                <div class="col-6 col-lg-3 d-grid mt-5 mb-3">
                                    <button class="bttn-pill bttn-md bttn-success" onclick="updateProfile();">Save Settings</button>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

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