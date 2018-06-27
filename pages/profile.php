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

$uiid = $_GET['uid'];
$wallet = $_GET['wallet'];
$spent = $_GET['spent'];
$nname = $_GET['name'];
$debt = $_GET['debt'];
$trans = rand(10,1000000);

$sql2 = "SELECT *, transactions.id AS tid, DATEDIFF(CURDATE(), aproved_date) AS days FROM transactions LEFT JOIN services ON services.id = transactions.service LEFT JOIN statuses ON statuses.id = transactions.status WHERE uid = '$uiid'";
 
 $res = mysqli_query($db,$sql2);
 $countt = mysqli_num_rows($res);

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
            <h1> <?php echo $nname; ?></h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>K <?=number_format($wallet,2);?></h3>

                <p>Subscription Plan</p>
              </div>
              <div class="icon">
                <i class="ion ion-card"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>K <?php echo number_format($money -> getspent($uiid),2); ?></h3>

                <p>Spent from Wallet</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>K <?php echo number_format($money -> getbalance($uiid),2); ?></h3>

                <p>Balance</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>K <?php echo number_format($money -> getdebt($uiid),2); ?></h3>

                <p>Owing</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      


 <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">All Transactions</h3>

                <div class="card-tools">

     <span class="pull-left"><a href="invoice.php?uiid=<?=$uiid?>&name=<?=$nname?>" class="btn btn-block btn-default btn-flat">
<span class="glyphicon glyphicon-plus"></span>Full Invoice</a></span>     


     
<span class="pull-left"><a href="#addnew" data-toggle="modal" class="btn btn-block btn-default btn-flat">
<span class="glyphicon glyphicon-plus"></span> Add Bill</a></span>
                 
                </div>
              </div>
             

 <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Transaction ID</th>
                      <th>Service Request</th>
                      <th>Cost of service</th>
                      <th>Activation Request</th>
                      <th>Expiry date</th>
                      <th>Status</th>
                      <th>Debt due</th>
                      <th>Approve</th>
                   
                    </tr>
                    </thead>
                   
                <tbody>
                
	<?php 

 if ($countt > 0) {

              while ($row = mysqli_fetch_array($res)) { $tid = $row['uid'];?>

    <tr>
        <td><a href="invoice.php?trans=<?php echo $row['transaction_id'];?>"><?php echo $row['transaction_id'];?></a></td>
 	<td><?php echo $row['service'];?></td>
	<td>K <?php echo number_format($row['amount'],2);?></td>
	<td><?php echo $row['request_date'];?></td>
        <td><?php echo $row['expiry_date'];?></td>
<?php

$status = $row ['status'] ;

  if ($status == 1) {
						$css = "badge-danger" ;
				}
				elseif($status == 2) {
						$css = "badge-success" ;
}

?>

	<td><span class="badge <?php echo $css; ?>"><?php echo $row['status_type'];?></span></td>



        <td><?php 

$days = $row['days'];

if ($days <= 30) {

$debt = (0.10 * $row['amount']) + $row['amount'];

} else if ($days >= 31 && $days <= 35) {

$debt = (0.20 * $row['amount']) + $row['amount'];

} else if ($days >= 36 && $days <= 40) {

$debt = (0.25 * $row['amount']) + $row['amount'];

} else if ($days >= 41 && $days <= 45) {

$debt = (0.30 * $row['amount']) + $row['amount'];

}


echo 'K ' . number_format($debt ,2);?>


</td>

<td>
							<a href="#edit<?php echo $row['tid']; ?>" data-toggle="modal" class="btn btn-block btn-outline-warning"><span class="glyphicon glyphicon-edit"></span> Approve</a>
							
						</td>

<td>
							
						
							<?php include('button.php'); ?>
						</td>

       
  </tr>

<?php } }?>
                </tbody>






                  </table>
                </div>
                <!-- /.table-responsive -->
<?php include('add_modal.php'); ?>
              </div>
              <!-- /.card-body -->




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
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
</body>
</html>
