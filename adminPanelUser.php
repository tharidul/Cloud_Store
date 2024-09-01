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
        <title>Admin Panel | NewTech Store</title>
    </head>

    <body class="main-body">

        <div class=" container-fluid">
            <div class="row">

                <?php include "adminheader.php" ?>


                <div class="col-12">
                    <div class="row justify-content-center">

                        <div class="col-9">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <input type="text" class=" mt-3 form-control" placeholder="Search Customer by Email">
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <button class="btn btn-primary mt-3">Search</button>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class=" col-12 col-lg-10  p-2">
                            <div class="row">

                                <div class="col-12">

                                    <table class=" table caption-top border-bottom border-dark ">
                                        <caption class="fw-bold fs-4">Customer Manage</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Account Status</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $userRs = Database::search("SELECT * FROM `user`");
                                            $user_num = $userRs->num_rows;

                                            for ($x = 0; $x < $user_num; $x++) {
                                                $user_data = $userRs->fetch_assoc();

                                                if ($user_data["status"] == 2) {
                                                    $button_icon = "bi bi-check-circle-fill";
                                                    $button_color = "btn-success";
                                                    $status_text = "Activated";
                                                } else {
                                                    $button_icon = "bi bi-x-circle-fill";
                                                    $button_color = "btn-danger";
                                                    $status_text = "Deactivated";
                                                }
                                            ?>
                                                <tr>
                                                    <td><?php echo $user_data["fname"] ?></td>
                                                    <td><?php echo $user_data["email"] ?></td>
                                                    <td><?php echo $user_data["mobile"] ?></td>
                                                    <?php
                                                    if ($user_data["status"] == 1) {
                                                    ?>
                                                        <td class=" text-success">Activated</td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td class=" text-danger">Deactivated</td>
                                                    <?php
                                                    }
                                                    ?>


                                                    <td>
                                                        <button class="btn <?php echo $button_color; ?>" onclick='userstatusChange("<?php echo $user_data["email"]; ?>","<?php echo $user_data["status"]; ?>");'>
                                                            <i class="<?php echo $button_icon; ?>"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>


                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                        <!-- Content -->

                    </div>
                </div>


                <?php include "footer.php"; ?>
            </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: adminSignIn.php");
} ?>