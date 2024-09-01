<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In | Cloud Store</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel = "stylesheet" href="bttn.css"/>
    <link rel="icon" href="resource/logo.png" />
</head>

<body class="back">
<div class=" container-fluid ">
        <div class="row justify-content-center">

            <div class="col-12 mb-5 mt-5 ">
                <div class="row text-center align-content-center">
                    <label class=" text-black fw-bold" style="font-size: 50px;"> Admin Login</label>
                </div>
            </div>

            <div class="col-12 col-lg-5 border border-2 p-4">
                <div class="row justify-content-center">
                    <div class="form-floating mb-3 col-12">
                        <input type="email" class="form-control" id="email">
                        <label for="floatingInput">Email</label>
                    </div>
                    <button  class="btn btn-danger" style="max-width:200px ;" onclick="adminSignIn();" >Sign In</button>

                </div>
            </div>


            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>