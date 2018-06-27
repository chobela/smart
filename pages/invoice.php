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

$uiid = $_GET['uiid'];
$cname = $_GET['name'];

$sql2 = "SELECT * FROM clients WHERE unique_id = '$uiid'";
$ress = mysqli_query($db,$sql2);
// Associative array
$k= mysqli_fetch_assoc($ress);




$sql = "SELECT * FROM transactions LEFT JOIN services ON services.id = transactions.service WHERE uid = '$uiid'";
 
$res = mysqli_query($db,$sql);
$count = mysqli_num_rows($res);


$s = "SELECT SUM(debt) AS total FROM transactions WHERE uid = '$uiid'";
 
$rre = mysqli_query($db,$s);
$tk= mysqli_fetch_assoc($rre);

$name = $_SESSION ['firstname'];


$menu = new Menu;
$money = new Money;
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Easy Bills</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<style>
@media print {
.header, .hide { visibility: hidden }
}
</style>

<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


<?php
 include("../includes/header.php");
 include("../includes/sidebar.php");
?>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> <?php echo $k['name'];?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Subscriptions</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
<div class="container-fluid">


        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fa fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to print.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="printableArea">
              <!-- title row -->
<?php $uiid = $_GET['uiid'];?>
              <div class="row">
                <div class="col-12">
                  <h4>
                     <img src="dist/img/credit/visa.png"> Easy - Bills.
                    <small class="float-right">Date: <?php echo date('Y-m-d')?></small>
                  </h4>
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
                    <strong><?php echo $cname; ?></strong><br>
                    <?php echo $k['address'];?><br>
                  
                    Phone:  <?php echo $k['phone'];?><br>
                    Email: <?=$k['email'];?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #001</b><br>
                 
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
 <th>Date due</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                
	<?php 

 if ($count > 0) {

              while ($row = mysqli_fetch_array($res)) { $tid = $row['id'];?>

    <tr>
        <td>1</td>
 	<td><?php echo $row['service'];?></td>
	<td><?php echo $row['transaction_id'];?></td>
	<td><?php echo $row['description'];?></td>
        <td><?php echo $row['expiry_date'];?></td>
        <td>K <?php echo number_format($row['debt'],2);?></td>
                  
<?php } }?>

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
                   Payments should be made within 7 days of invoice.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                 

                  <div class="table-responsive">
                    <table class="table">
                     
                      <tr>
                        <th>Tax (16%):</th>
                        <td></td>
                      </tr>
                   
                      <tr>
                        <th>Total: K <?php echo number_format($tk['total'],2);?></th>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  

 <a onclick="printDiv('printableArea')" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                 
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include ("../includes/footer.php");?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="s../dist/js/demo.js"></script>
<!-- page script -->
 <script type="text/javascript">     
   function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
 </script>
</body>
</html>
