<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 include("config.php");
 include("classes/Menu.php");
 include("classes/Perf.php");
 session_start();

$link = $_SERVER['PHP_SELF']; 

 if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['usergroup']) && !isset ($_SESSION ['firstname'])   && !isset ($_SESSION ['email'])) {

 header('Location:login.php');

} else

if ($_SESSION ['usergroup'] != '1') {

 header('Location:user.php');

} 

$name = $_SESSION ['firstname'];

$sql = "SELECT mcode, interest, DATEDIFF(CURDATE(), aproved_date) AS days, reconciliation.status AS recon, SUM(amount) AS amount, month, services.service AS service, count(transactions.service) AS ss FROM `transactions`JOIN months ON months.mcode =  Month(transactions.aproved_date) LEFT JOIN services ON transactions.service = services.id LEFT JOIN reconciliation ON months.recon = reconciliation.id WHERE transactions.status = 2 group by transactions.service order by mcode asc;";
 
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);

$menu = new Menu;
$perf = new Perf;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Easy Bills</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- DataTables -->
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
 

<?php
 include("includes/header.php");
 include("includes/sidebar.php");

 ?>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Summary</h1>
          </div><!-- /.col -->
          

<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->

<div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                    
                      <h5 class="description-header">K210,000.00</h5>
                      <span class="description-text">TOTAL FLOAT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-money"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Spent</span>
                <span class="info-box-number">K <?php echo number_format($perf -> totalspent(),2); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

 <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-line-chart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Overal Interest Earned</span>
                <span class="info-box-number">K <?php echo number_format($perf -> totalinterest(),2); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

 <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-money"></i></span>

              <div class="info-box-content" onClick="#">
                <span class="info-box-text">Total Debt Due</span>
                <span class="info-box-number">K <?php echo number_format($perf -> totaldebt(),2); ?></span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Subscriptions</span>
                <span class="info-box-number"><?php echo ($perf -> totalsubs()); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


 <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">2018 Performance</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
             

 <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">




                  <table  id="example" class="table m-0">
                    <thead>
                    <tr>
                      <th>Month</th>
                      <th>Most delivered service</th>
                      <th>Reconciliation</th>
                      <th>Amount spent</th>
                      <th>Interest earned</th>
                      <th>Total Debt due to us</th>
                    </tr>
                    </thead>
                    <tbody>

                    
                   <?php 

 if ($count > 0) {

              while ($row = mysqli_fetch_array($result)) { $mcode = $row['mcode'];?>

    <tr>
        <td><a href="pages/examples/invoice.html"><?php echo $row['month'];?></a></td>
 	<td><?php echo $row['service'];?></td>

<td>
<?php 

if ($row['recon'] == 'Done') {

echo '<span class="badge badge-success">'.$row['recon'].'</span>';

} else {

echo '<span class="badge badge-danger">'.$row['recon'].'</span>';

}

?>
</td>

	<td>K<?php echo number_format($row['amount'],2);?></td>


<td><?php 

$days = $row['days'];

if ($days <= 30) {

$debt = (($row['interest'] * $row['amount']) * $days);

} else if ($days >= 31 && $days <= 35) {

$debt = (0.20 * $row['amount']);

} else if ($days >= 36 && $days <= 40) {

$debt = (0.25 * $row['amount']);

} else if ($days >= 41 && $days <= 45) {

$debt = (0.30 * $row['amount']);

}


echo 'K ' . number_format($debt ,2);?>


</td>

        <td>K<?php 

$due  = ($debt + $row['amount']);

echo number_format($due ,2);?></td>
      
  </tr>

<?php } }?>
                    </tbody>


                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
 <?php include ("includes/footer.php");?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="plugins/chartjs-old/Chart.min.js"></script>
<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>


<!-- DataTables -->
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

 <script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>

<script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

  <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

<script>
  $(function () {
    $("#example").DataTable(
{
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    }
);
   
  });
</script>
</body>
</html>
