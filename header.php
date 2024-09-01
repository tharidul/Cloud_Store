<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

</head>

<body>

  <nav class="navbar head navbar-expand-lg  mb-2 shadow" style="height:60px">
    <div class="container-fluid">
      <a href="home.php"><img src="resource/logo.png" style="height: 40px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              My Account
            </a>
            <ul class="dropdown-menu ">
              <li><a class="dropdown-item" href="home.php"><i class="bi bi-house-door"></i></i>&nbsp;&nbsp;&nbsp;Homepage</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="cart.php"><i class="bi bi-cart-check"></i>&nbsp;&nbsp;&nbsp;Shopping Cart</a></li>
              <li><a class="dropdown-item" href="watchlist.php"><i class="bi bi-bookmark-heart"></i>&nbsp;&nbsp;&nbsp;Watchlist</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="accSettings.php"><i class="bi bi-person-circle"></i>&nbsp;&nbsp;&nbsp;Account Settings</a></li>
              <li><a class="dropdown-item" href="myOrders.php"><i class="bi bi-bag-check-fill"></i></i>&nbsp;&nbsp;&nbsp;My Oders</a></li>
              <li><a class="dropdown-item" href="purchaseHistory.php"><i class="bi bi-clock-history"></i>&nbsp;&nbsp;&nbsp;Purchase History</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="myShop.php"><i class="bi bi-shop"></i>&nbsp;&nbsp;&nbsp; My Shop</a></li>

            </ul>
          </li>
          <li class="nav-item">

            <?php

            session_start();

            if (isset($_SESSION["u"])) {

              $data = $_SESSION["u"];
            ?>
              <span class="nav-link  fw-bold text-dark">Hi ! <?php echo $data["fname"]; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold text-secondary " href="#" onclick="signout();">Log Out</a>
          </li>
        <?php

            } else {

        ?>
          <li class=" nav-item">
            <a href="index.php" class="fw-bold text-primary nav-link">Login In or Register</a>
          </li>
        <?php

            }

        ?>


        </ul>
      </div>
    </div>
  </nav>
</body>

</html>