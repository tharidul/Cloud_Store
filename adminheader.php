<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" style="max-width: 300px;" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Cloud Store Admin Panel</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">Overview</a>
          </li>
          <li class="nav-item mt-2 ">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelUser.php">Customer Manage</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminProductManage.php">Product Manage</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">Orders</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminSeller.php">Seller Management</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">Chat</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">File Manager</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">Analytics</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">Calender</a>
          </li>
          <li class="nav-item mt-2">
            <a class="nav-link active border-bottom border-secondary" aria-current="page" href="adminPanelOverView.php">Admin Settings</a>
          </li>

          <li class="nav-item mt-4">
            <a class="nav-link active btn btn-primary " aria-current="page" href="index.php">Homepage</a>
          </li>

          <li class="nav-item mt-4">
            <a class="nav-link active btn btn-danger" onclick="adminSignout();" aria-current="page" href="adminSignIn.php">Logout</a>
          </li>
          
        </ul>
        
      </div>
    </div>
  </div>
</nav>
    
</body>
</html>