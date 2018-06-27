<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
include("../classes/Menu.php");
include("Money.php");
include('conn.php');
session_start();
$link = $_SERVER['PHP_SELF']; 




if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['usergroup']) && !isset ($_SESSION ['firstname'])   && !isset ($_SESSION ['email'])) {

 header('Location:../login.php');

} else

if ($_SESSION ['usergroup'] != '1') {

 header('Location:user.php');

} 

$sql = "SELECT * FROM clients";
 
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);

$tid = $_GET['trans'];

$sql2 = "SELECT *, services.service AS sss FROM transactions JOIN clients ON transactions.uid = clients.unique_id LEFT JOIN services ON services.id = transactions.service WHERE transactions.transaction_id = '$tid'";
 
 $res = mysqli_query($db,$sql2);
$r=mysqli_fetch_assoc($res);

$name = $_SESSION ['firstname'];
$cname = $r['name'];

$menu = new Menu;
$money = new Money;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> AdminLTE, Inc.
          <small class="float-right">Date: 2/10/2014</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
  
         <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Easy-Bills.</strong><br>
                    5827 Lusemfwa Road<br>
                    Kalundu<br>
                    Phone: (260) 295486<br>
                    Email: easybills@ksm.co.zm
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?=$cname?></strong><br>
                    <?=$r['address']?><br>
                  
                    Phone:  <?=$r['phone']?><br>
                    Email: <?=$r['email']?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?=$tid?></b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> <?=$r['aproved_date']?><br>
                  <b>Account:</b> <?=$r['account']?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Service</th>
                      <th>Transaction #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td><?=$r['sss']?></td>
                      <td><?=$tid?></td>
                      <td><?=$r['description']?></td>
                      <td>K <?=number_format($r['amount'],2)?></td>
                    </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                 

                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due <?=$r['expiry_date']?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->




  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
