<?php
session_start();
require "connction.php";
if (isset($_SESSION["u"])) {
   $user_mail = $_SESSION["u"]["email"];
   $oid = $_GET["oid"];
?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="invoice.css" />
      <link rel="stylesheet" href="bootstrap.css" />
      <link rel="icon" href="resource/logo.png" />
      <title>Invoice | Cloud Store</title>
   </head>

   <body>

      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
      <div class="container mt-5">
         <div class="col-md-12">
            <div class="invoice">
               <!-- begin invoice-company -->
               <div class="invoice-company text-inverse f-w-600">
                  <span class="pull-right hidden-print">
                     <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
                     <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                  </span>
                  Cloud Store , Inc
               </div>
               <!-- end invoice-company -->
               <!-- begin invoice-header -->
               <div class="invoice-header">

                  <?php
                  $address_rs = Database::search("SELECT * FROM `user_has_address`
               INNER JOIN `user` ON user_has_address.user_email = user.email INNER JOIN `city` ON user_has_address.city_id = city.id WHERE `user_email` = '" . $user_mail . "'");
                  $address_data = $address_rs->fetch_assoc();

                  $item_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON invoice.product_id = product.id WHERE order_id = '" . $oid . "'");
                  $item_num = $item_rs->num_rows;




                  // $dateString = ($item_data["date_time"]);
                  // $datetime = new DateTime($dateString);
                  // $date = $datetime->format('Y-m-d');
                  ?>

                  <div class="invoice-to">
                     <small>to</small>
                     <address class="m-t-5 m-b-5">
                        <strong class="text-inverse"><?php echo $address_data["fname"] ?> <?php echo $address_data["lname"] ?></strong><br>
                        <?php echo $address_data["line1"] ?> <br>
                        <?php echo $address_data["line2"] ?><br>
                        <?php echo $address_data["name"] ?>, <?php echo $address_data["postal_code"] ?><br>
                        Phone: <?php echo $address_data["mobile"] ?><br>
                        Email: <?php echo $user_mail ?>
                     </address>
                  </div>
                  <div class="invoice-date">
                     <!-- <div class="date text-inverse m-t-5"><?php echo $date ?></div> -->
                     <div class="invoice-detail">
                        #<?php echo $oid ?><br>
                        Services Product
                     </div>
                  </div>
               </div>
               <!-- end invoice-header -->
               <!-- begin invoice-content -->
               <div class="invoice-content">
                  <!-- begin table-responsive -->
                  <div class="table-responsive">

                     <table class="table table-invoice">
                        <thead>
                           <tr>
                              <th>DESCRIPTION</th>
                              <th class="text-center" width="10%">Cost per unit</th>
                              <th class="text-center" width="10%">QTY</th>
                              <th class="text-right" width="20%">SUB TOTAL</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");
                           $total = 0; 
                           $shipping = 0;
                           for ($x = 0; $x < $item_num; $x++) {
                              $item_data = $item_rs->fetch_assoc();
                              $invoice_data = $invoice_rs->fetch_assoc();
                              $subTotal = ($item_data["price"]) * ($invoice_data["qty"]);
                              $shipping += $item_data["delivary_fee"];
                              $total += $subTotal;
                           ?>
                              <tr>
                                 <td>
                                    <span class="text-inverse"><?php echo $item_data["title"]; ?></span><br>
                                 </td>
                                 <td class="text-center">LKR <?php echo number_format($item_data["price"], 2, '.', ','); ?></td>
                                 <td class="text-center"><?php echo $invoice_data["qty"]; ?></td>
                                 <td class="text-right">LKR <?php echo number_format($subTotal, 2, '.', ','); ?></td>
                              </tr>
                           <?php
                           }
                           ?>

                        </tbody>

                     </table>
                  </div>
                  <!-- end table-responsive -->
                  <!-- begin invoice-price -->
                  <div class="invoice-price">
                     <div class="invoice-price-left">
                        <div class="invoice-price-row">
                           <div class="sub-price">
                              <small>TOTAL</small>
                              <span class="text-inverse">LKR <?php echo number_format($total, 2, '.', ','); ?></span>
                           </div>
                           <div class="sub-price">
                              <i class="fa fa-plus text-muted"></i>
                           </div>
                           <div class="sub-price">
                              <small>SHIPPING FEE</small>
                              <span class="text-inverse">LKR <?php echo number_format($shipping, 2, '.', ','); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="invoice-price-right">
                        <?php
                        $grand_total = $total + $shipping;
                        ?>
                        <small>GRAND TOTAL</small> <span class="f-w-600">LKR <?php echo number_format($grand_total, 2, '.', ','); ?>
                        </span>
                     </div>
                  </div>
                  <!-- end invoice-price -->
               </div>
               <!-- end invoice-content -->
               <!-- begin invoice-note -->
               
               <!-- end invoice-note -->
               <!-- begin invoice-footer -->
               <div class="invoice-footer">
                  <p class="text-center m-b-5 f-w-600">
                     THANK YOU FOR YOUR BUSINESS
                  </p>
                  <p class="text-center">
                     <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> cloudstore.com</span>
                     <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:011-5555 663</span>
                     <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> cloudstore@eshop.com</span>
                  </p>
               </div>
               <!-- end invoice-footer -->
            </div>
         </div>
      </div>
      </div>
      <script src="bootstrap.js"></script>
   </body>

   </html>
<?php
} else {
}
?>