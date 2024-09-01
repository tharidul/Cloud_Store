<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign UP | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">

    <div class=" container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <?php
            if (isset($_SESSION["u"])) {

                header("Location:home.php");
            } else {
            ?>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 shadow p-1">
                            <div class="row g-1 justify-content-center">

                                <div class=" col-lg-4 side vh-100 d-none d-lg-block p-5">

                                    <img src="resource/logo.png" class=" img-fluid ">

                                </div>

                                <div class=" col-lg-7 col-12 ">
                                    <div class="row justify-content-center">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                                <div class="col-6  d-grid">
                                                    <button class="nav-link text-dark active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Register</button>
                                                </div>

                                                <div class="col-6 d-grid">
                                                    <button class="nav-link text-dark" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Login In</button>
                                                </div>

                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <!-- Register -->
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="col-12 p-3">
                                                    <div class="col-12 ">
                                                        <div class="row g-1 justify-content-center">

                                                            <div class="col-12 text-center">
                                                                <label class="text-center fs-3 fw-bold">Create Account</label>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mt-3 mb-2">
                                                                <input type="text" class=" form-control" placeholder="First Name" id="f">
                                                            </div>
                                                            <div class="col-12 col-lg-6 mt-3 mb-2">
                                                                <input type="text" class=" form-control" placeholder="Last Name" id="l">
                                                            </div>
                                                            <div class="col-12 mt-3 mb-2">
                                                                <input type="email" class=" form-control" placeholder="Email" id="e">
                                                            </div>
                                                            <div class="col-12 mt-3 mb-2">
                                                                <input type="password" class=" form-control" placeholder="Password must be between 8 - 20 charcters" id="p">
                                                            </div>
                                                            <div class="col-12 col-lg-6 mt-3 mb-2">
                                                                <input type="text" class=" form-control" placeholder="Mobile No." id="m">
                                                            </div>
                                                            <div class="col-12 col-lg-6 mt-3 mb-2">

                                                                <select class="form-select" id="g">
                                                                    <option selected>Select Gender</option>
                                                                    <?php

                                                                    require "connction.php";

                                                                    $rs = Database::search("SELECT * FROM `gender`");
                                                                    $n = $rs->num_rows;

                                                                    for ($x = 0; $x < $n; $x++) {

                                                                        $data = $rs->fetch_assoc();

                                                                    ?>
                                                                        <option value="<?php echo $data["id"]; ?>"><?php echo $data["gender"]; ?></option>
                                                                    <?php
                                                                    }

                                                                    ?>
                                                                </select>

                                                            </div>

                                                            <div class="col-8 col-lg-4  mt-5 d-grid mb-2">
                                                                <button class="btn btn-primary" onclick="signUP();">Create Account</button>
                                                            </div>

                                                            <div>
                                                                <hr>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Register -->


                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <div class="col-12 p-3">
                                                    <div class="row">
                                                        <label class="text-center fs-3 fw-bold">Login to Account</label>
                                                        <div class="col-12 mt-3 mb-2">
                                                            <input type="email" class=" form-control" placeholder="Email" id="e2">
                                                        </div>
                                                        <div class="col-12 mt-3 mb-2">
                                                            <input type="password" class=" form-control" placeholder="Password" id="p2">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-6 mt-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="rem">
                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                        Remember me !
                                                                    </label>
                                                                </div>

                                                            </div>

                                                            <div class="col-6 mt-4 text-end">
                                                                <a class="fs-6" href="#" onclick="forgotPassword();"><span>Forgot Password ?</span></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-4">
                                                        <div class="row justify-content-center">
                                                            <div class="col-8 col-lg-4 d-grid">
                                                                <button class="btn btn-primary" onclick="signIn();">Login In</button>
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



                    </div>

                </div>


                <?php include "footer.php"; ?>

                <!--Forgot Password Model -->
                <div class="modal" tabindex="-1" id="fpModel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Account Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="number" class="form-control" placeholder="Enter OTP" id="otp">
                                <input type="password" class="form-control mt-3" placeholder="New Password" id="newPassword">
                                <input type="password" class="form-control mt-3" placeholder="Re-type Password" id="retypePassword">

                                <div id="passwordMessage" class="mt-2"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="confirmButton" onclick="passwordResetConfirm();" disabled>Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Forgot Password Model -->
        </div>
    </div>
    <!-- Password cheaking Script -->
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const newPassword = document.getElementById('newPassword');
        const retypePassword = document.getElementById('retypePassword');
        const passwordMessage = document.getElementById('passwordMessage');
        const confirmButton = document.getElementById('confirmButton');

        function checkPassword() {
            const password = newPassword.value;
            const retype = retypePassword.value;

            if (password.length < 5 || password.length > 20) {
                passwordMessage.textContent = 'Password must be between 5 and 20 characters';
                passwordMessage.style.color = 'red';
                confirmButton.disabled = true;
            } else if (password !== retype) {
                passwordMessage.textContent = 'Passwords do not match';
                passwordMessage.style.color = 'red';
                confirmButton.disabled = true;
            } else {
                passwordMessage.textContent = 'Passwords match';
                passwordMessage.style.color = 'green';
                confirmButton.disabled = false;
            }
        }

        newPassword.addEventListener('input', checkPassword);
        retypePassword.addEventListener('input', checkPassword);
    });
</script>

    <!-- Password cheaking Script -->
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
            }
?>